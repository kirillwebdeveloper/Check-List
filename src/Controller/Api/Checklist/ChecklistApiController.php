<?php

namespace App\Controller\Api\Checklist;

use App\Controller\Api\CoreRestApiController;
use App\Model\Request\Api\Checklist\ChecklistRequest;
use App\Model\Response\ApiResponse;
use App\Service\ChecklistService\CheckList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Exception\Api\ApiException;
use App\Exception\Json\MalformedJsonException;

/**
 * Class ChecklistApiController
 * @package App\Controller\Api\Checklist
 *
 * @Route("/api/checklist", name="api_checker_")
 */
class ChecklistApiController extends CoreRestApiController
{
    /**
     * @param Request   $request
     * @param CheckList $checkList
     *
     * @return ApiResponse
     *
     * @throws ApiException
     * @throws MalformedJsonException
     *
     * @Route(
     *     "",
     *     name="checklist",
     *     methods={"POST"}
     * )
     */
    public function checklist(
        Request $request,
        CheckList $checkList
    ) {
        $requestData = $this->deserialize(
            (string)$request->getContent(false),
            ['check'],
            ChecklistRequest::class
        );

        $this->validate($requestData);

        $response = $checkList
            ->check($requestData);

        return $this->serialize($response, ApiResponse::HTTP_OK, ['check']);
    }
}