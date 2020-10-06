<?php

namespace App\Controller;

use App\Document\Disease;
use App\Document\Drug;
use App\Document\PrescriptionLog;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DiseaseController extends AbstractController
{
    /**
     * @param DocumentManager $dm
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @Route("/disease/{id}", name="disease", requirements={"page" = "\d+"}, methods={"GET", "POST"})
    */
    public function getDiseaseById(DocumentManager $dm, Request $request, int $id): JsonResponse
    {
        $parameterArray = [];
        if ($content = $request->getContent()) {
            $parameterArray = json_decode($content, true);
        }

        $repository = $dm->getRepository(Disease::class);
        $disease = $repository->find($id);

        if (!empty($parameterArray['name'])) {
            $prescriptionLog = new PrescriptionLog();
            $prescriptionLog->setName($parameterArray['name']);
            $prescriptionLog->setDate(new \DateTime());
            $prescriptionLog->setDisease($disease);
            $dm->persist($prescriptionLog);
            $dm->flush();
        }

        return $this->json($disease);
    }
}
