<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\ApplicationStatus;
use App\Models\Application;
use App\Models\User;
use App\Repositories\ReadApproval\IReadApprovalRepository;
use Illuminate\Database\Eloquent\Collection;

class ApplicationService
{
    protected $applicationRepository;

    protected $readApprovalRepository;

    /**
     * @param $readApprovalRepository
     */
    public function __construct(
        IReadApprovalRepository $readApprovalRepository
    ) {
        $this->readApprovalRepository = $readApprovalRepository;
    }

    public function justApproved($application): bool
    {
        if (!$application) {
            return false;
        }

        $unread = $application->readApproval->isEmpty();
        $approved = $application->status === ApplicationStatus::APPROVED;

        return $unread && $approved;
    }

    public function createReadApproval($application)
    {
        return $this->readApprovalRepository->create($application);
    }

    /**
     * ユーザーに紐付いた申請を取得する
     * @param User $user
     * @return Collection
     */
    public function fetchApplications(User $user): Collection 
    {
        $userIdKey = $user->is_mentor ? 'mentor_id' : 'mentee_id';
        
        $applications = Application::where($userIdKey, $user->id)
            ->where('status', ApplicationStatus::APPLIED) // 申請中のみ
            ->with('mentee') // 申請者のユーザー情報も同時に取得
            ->get();

        return $applications;
    }
}
