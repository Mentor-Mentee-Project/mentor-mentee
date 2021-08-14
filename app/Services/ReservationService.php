<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\User;
use App\Repositories\Reservation\IReservationRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    protected $reservationRepository;

    public function __construct(
        IReservationRepository $reservationRepository,
        IUserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function getReservationsByUser(User $user)
    {
        return $user->is_mentor
            ? $this->reservationRepository->getByMentorId($user->id)
            : $this->reservationRepository->getByMenteeId($user->id);
    }

    public function getUpcomingReservationsByUser($user)
    {
        return $this->reservationRepository->getUpcomingByUser($user)->sortBy('date');
    }

    public function store(StoreReservationRequest $request)
    {
        $userId = $this->userRepository->getBySub(Auth::id())->id;
        return $this->reservationRepository->store($request, $userId);
    }

    public function update(UpdateReservationRequest $request)
    {
        return $this->reservationRepository->update($request);
    }
}
