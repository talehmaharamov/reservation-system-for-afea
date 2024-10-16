<?php

namespace App\Controllers;

use App\Models\EventsModel;
use App\Models\ReservationModel;

class Home extends BaseController
{
    protected EventsModel $eventModel;
    protected ReservationModel $reservationModel;

    public function __construct()
    {
        $this->eventModel = new EventsModel();
        $this->reservationModel = new ReservationModel();
    }

    public function index()
    {
        $events = $this->eventModel->findAll();

        if (empty($events)) {
            return redirect()->to('/')->with('error', 'No events available at this time.');
        }

        foreach ($events as &$event) {
            $eventId = $event['id'];
            $event['reservations'] = $this->reservationModel->where('event_id', $eventId)->findAll();
        }

        $data['availableSeats'] = $this->eventModel->getAvailableSeats($events[0]['id']);
        $data['events'] = $events;
        return view('index', $data);
    }


    public function store()
    {
        $eventId = $this->request->getPost('event_id');
        $name = $this->request->getPost('name');

        $availableSeats = $this->eventModel->getAvailableSeats($eventId);
        if ($availableSeats <= 0) {
            return redirect()->back()->with('error', 'No available seats for this event.');
        }

        $seatNumber = $this->reservationModel->getNextSeatNumber($eventId);

        $this->reservationModel->save([
            'event_id' => $eventId,
            'name' => $name,
            'seat_number' => $seatNumber,
        ]);

        //Modeldə kommentdə qeyd etdiyim kimi bunuda istifadə edə bilərik
//        $this->eventModel->decreaseAvailableSeats($eventId);
        return redirect()->route('/')->with('success', 'Reservation successful!');
    }
    public function getAvailableSeats($eventId)
    {
        $availableSeats = $this->eventModel->getAvailableSeats($eventId);
        return $this->response->setJSON(['availableSeats' => $availableSeats]);
    }
}
