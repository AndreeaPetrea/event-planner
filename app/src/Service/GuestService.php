<?php

namespace App\Service;

use App\Entity\Guest;
use App\Entity\GuestGroup;
use App\Repository\GuestGroupRepository;
use App\Repository\GuestRepository;

class GuestService
{
    public function __construct(
        private GuestGroupRepository $guestGroupRepository,
        private GuestRepository $guestRepository,
    ) {}

    public function getGuestGroupId(string $groupName): int
    {
        $guestGroup = $this->guestGroupRepository->findOneBy(['name' => $groupName]);

        if($guestGroup) {
            return $guestGroup->getId();
        }

        $this->guestGroupRepository->add((new GuestGroup())->setName($groupName), true);
        $guestGroup = $this->guestGroupRepository->findOneBy(['name' => $groupName]);

        return $guestGroup->getId();
    }

    public function createGuest(Guest $guest): void
    {
        $this->guestRepository->add($guest, true);
    }

    public function updateGuest(Guest $guest): void
    {
        $this->guestRepository->add($guest, true);
    }

    public function updateGuestStatus(int $guestId, string $status): void
    {
        $guest = $this->guestRepository->findOneBy(['id' => $guestId]);
        $guest->setStatus($status);
        $this->guestRepository->add($guest, true);
    }

    public function updateMultipleGuestStatus(array $guestIds, string $status): void
    {
        $this->guestRepository->massUpdateStatus($guestIds, $status);
    }

    public function deleteMultipleGuests(array $guestIds): void
    {
        $this->guestRepository->massDeleteGuest($guestIds);
    }

}