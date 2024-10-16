<?php

namespace App\Models;

use CodeIgniter\Model;

class EventsModel extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'date', 'total_seats'];

    public function getAvailableSeats($eventId)
    {
        $totalSeats = $this->find($eventId)['total_seats'];
        $reservedSeats = (new ReservationModel())->where('event_id', $eventId)->countAllResults();
        return $totalSeats - $reservedSeats;
    }

    //Hər dəfə total_seatsı azalda da bilərik,lakin zənnimcə bu məlumat itkisi olar,
    //əgər eventların hamısında standart olaraq eyni sayda total seat olsa bəlkə hə,
    //amma əks təqdirdə məntiqli deyil zənnimcə azaltmaq.Sadəcə qeyd etmək istədim ki belə bir varintda yaza bilərik :)

//    public function decreaseAvailableSeats($eventId)
//    {
//        $this->set('total_seats', 'total_seats - 1', false) // Decrease only for the selected event
//        ->where('id', $eventId)
//            ->update();
//    }
}
