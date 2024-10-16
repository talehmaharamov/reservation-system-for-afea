<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['event_id', 'name', 'seat_number'];

    //Seat numberləri statik olaraq +1 formatında vermişəm basic variantda,lakin bunu istənilən şəraitdə dynamic etmək olar
    public function getNextSeatNumber($eventId)
    {
        return $this->where('event_id', $eventId)->countAllResults() + 1;
    }
}
