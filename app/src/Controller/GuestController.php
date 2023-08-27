<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Repository\GuestRepository;
use App\Service\GuestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GuestController extends AbstractController
{
    /**
     * @Route("/save-guest", name="saveGuest", methods={"POST", "GET"})
     */
    public function saveGuest(Request $request, GuestService $guestService): JsonResponse
    {
        $name = $request->get('name');
        $ageGroup = $request->get('ageGroup');
        $groupName = $request->get('groupName');
        $note = $request->get('note');
        $eventId = $request->get('eventId');
        $phoneNumber = $request->get('phoneNumber');

        if (!$name) {
            return $this->json(['message' => 'Please insert guest name'], 500);
        }

        if ($groupName) {
            $groupId = $guestService->getGuestGroupId($groupName);
        }

        $guest = (new Guest())
            ->setName($name)
            ->setAgeGroup($ageGroup)
            ->setPhoneNo($phoneNumber)
            ->setNote($note)
            ->setEventId($eventId)
            ->setStatus('toBeInvited')
            ->setGroupId($groupId);

        $guestService->createGuest($guest);

        return $this->json(['message' => 'Guest created']);
    }

    /**
     * @Route("/update-guest", name="updateGuest", methods={"POST", "GET"})
     */
    public function updateGuest(Request $request, GuestService $guestService, GuestRepository $guestRepository): JsonResponse
    {
        $name = $request->get('name');
        $ageGroup = $request->get('ageGroup');
        $group = $request->get('group');
        $note = $request->get('note');
        $eventId = $request->get('eventId');
        $phoneNumber = $request->get('phoneNumber');
        $guestId = $request->get('guestId');

        $guest = $guestRepository->findOneBy(['id' => $guestId]);

        if (!$guest) {
            return $this->json(['message' => 'Guest was not found'], 500);
        }

        if ($group) {
            $groupId = $guestService->getGuestGroupId($group);
        }

        $guest
            ->setName($name)
            ->setAgeGroup($ageGroup)
            ->setPhoneNo($phoneNumber)
            ->setNote($note)
            ->setEventId($eventId)
            ->setGroupId($groupId);

        $guestService->updateGuest($guest);

        return $this->json(['message' => 'Guest updated']);

    }

    /**
     * @Route("/update-guest-status", name="updateGuestStatus", methods={"POST", "GET"})
     */
    public function updateGuestStatus(Request $request, GuestService $guestService): JsonResponse
    {
        $guestId = $request->get('guestId');
        $status = $request->get('status');

        if (!$status) {
            return $this->json(['message' => 'Please provide status'], 500);
        }

        $guestService->updateGuestStatus($guestId, $status);

        return $this->json(['message' => 'Guest status updated']);
    }

    /**
     * @Route("/mass-update-guest-status", name="massUpdateGuestStatus", methods={"POST", "GET"})
     */
    public function massUpdateGuestStatus(Request $request, GuestService $guestService): JsonResponse
    {
        $guestIds = $request->get('guestIds');
        $status = $request->get('status');

        if (!$status) {
            return $this->json(['message' => 'Please provide status'], 500);
        }

        $guestService->updateMultipleGuestStatus($guestIds, $status);

        return $this->json(['message' => 'Guest status updated']);
    }

    /**
     * @Route("/mass-delete-guests", name="massDeleteGuests", methods={"POST", "GET"})
     */
    public function massDeleteGuests(Request $request, GuestService $guestService): JsonResponse
    {
        $guestIds = $request->get('guestIds');
        $guestService->deleteMultipleGuests($guestIds);

        return $this->json(['message' => 'Guests deleted']);
    }
}