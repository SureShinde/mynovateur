<?php
/**
 * Redstage Logger module to log all incoming and outgoing request and responses to and from Magento
 *
 * @category: PHP
 * @package: Redstage/Logger
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Logger
 */
namespace Redstage\Logger\Model;

use Redstage\Logger\Model\LoggerFactory;
use Redstage\Logger\Model\ResourceModel\Logger;

/**
 * Class Log
 * @package Redstage\Logger\Model
 */
class Log
{
    /**
     * @var \Redstage\Logger\Model\LoggerFactory
     */
    protected $loggerFactory;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Log constructor.
     * @param \Redstage\Logger\Model\LoggerFactory $loggerFactory
     * @param Logger $logger
     */
    public function __construct(
        LoggerFactory $loggerFactory,
        Logger $logger
    )
    {
        $this->loggerFactory = $loggerFactory;
        $this->logger = $logger;
    }

    /**
     * @param null $requestType
     * @param null $requestData
     * @param null $responseData
     * @param null $status
     * @throws \Exception
     */
    public function addLogRecord($requestType = null, $requestData = null, $responseData = null, $status = null) {
        try {
            $loggerModel = $this->loggerFactory->create();
            $loggerModel->setRequestType($requestType);
            $loggerModel->setRequestData($requestData);
            $loggerModel->setResponseData($responseData);
            $loggerModel->setStatus($status);
            $this->logger->save($loggerModel);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
