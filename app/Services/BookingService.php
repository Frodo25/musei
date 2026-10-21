<?php
namespace App\Services;

use App\Contracts\SmsSender;
use App\Models\Exhibit;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function __construct(private SmsSender $sms) {}

    public function create(User $user, Exhibit $exhibit, array $data): Booking
    {
        $active = $user->bookings()->where('status', 'new')->count();
        if ($active >= 3) {
            throw ValidationException::withMessages([
                'phone' => 'У вас уже есть 3 необработанные заявки.',
            ]);
        }

        $booking = $user->bookings()->create($data + ['exhibit_id' => $exhibit->id]);

        $this->sms->send($data['phone'], "Ваша заявка №{$booking->id} на экскурсию принята.");

        return $booking;
    }
}