<?php

namespace Fantronix\ReturnOrder\Model;

use Magento\Framework\Phrase;
use Fantronix\ReturnOrder\Api\Data\GridInterface;

class ReturnOrder extends \Magento\Framework\Model\AbstractModel implements GridInterface
{

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    protected function _construct()
    {
        $this->_init('Fantronix\ReturnOrder\Model\ResourceModel\ReturnOrder');
    }

    public function getId(){
        return $this->getData(self::ENTITY_ID);
    }
    /**
     * Set EntityId.
     */
    public function setId($id){
        return $this->setData(self::ENTITY_ID, $id);
    }
    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getFirstname(){
        return $this->getData(self::FIRSTNAME);
    }
    /**
     * Set Title.
     */
    public function setFirstname($firstname){
        return $this->setData(self::FIRSTNAME, $firstname);
    }
    /**
     * Get Lastname.
     *
     * @return varchar
     */
    public function getLastname(){
        return $this->getData(self::LASTNAME);
    }
    /**
     * Set Lastname.
     */
    public function setLastname($lastname){
        return $this->setData(self::LASTNAME, $lastname);
    }
    /**
     * Get Email.
     *
     * @return varchar
     */
    public function getEmail(){
        return $this->getData(self::EMAIL);
    }
    /**
     * Set Email.
     */
    public function setEmail($email){
        return $this->setData(self::EMAIL, $email);
    }
    /**
     * Get ContactNumber
     *
     * @return varchar
     */
    public function getContactNumber(){
        return $this->getData(self::CONTACT_NUMBER);
    }
    /**
     * Set ContactNumber.
     */
    public function setContactNumber($contactNumber){
        return $this->setData(self::CONTACT_NUMBER, $contactNumber);
    }
    /**
     * Get Address.
     *
     * @return varchar
     */
    public function getAddress(){
        return $this->getData(self::ADDRESS);
    }
    /**
     * Set Address.
     */
    public function setAddress($address){
        return $this->setData(self::ADDRESS, $address);
    }
    /**
     * Get OrderNumber.
     *
     * @return int
     */
    public function getOrderNumber(){
        return $this->getData(self::ORDER_NUMBER);
    }
    /**
     * Set OrderNumber.
     */
    public function setOrderNumber($orderNumber){
        return $this->setData(self::ORDER_NUMBER, $orderNumber);
    }
    /**
     * Get PurchaseDate.
     *
     * @return varchar
     */
    public function getPurchaseDate(){
        return $this->getData(self::PURCHASE_DATE);
    }
    /**
     * Set PurchaseDate.
     */
    public function setPurchaseDate($purchaseDate){
        return $this->setData(self::PURCHASE_DATE, $purchaseDate);
    }
    /**
     * Get ProductData.
     *
     * @return date
     */
    public function getProductData(){
        return $this->getData(self::PRODUCT_DATA);
    }
    /**
     * Set ProductData.
     */
    public function setProductData($productData){
        return $this->setData(self::PRODUCT_DATA, $productData);
    }
    /**
     * Get ContactReason.
     *
     * @return varchar
     */
    public function getContactReason(){
        return $this->getData(self::CONTACT_REASON);
    }
    /**
     * Set ContactReason.
     */
    public function setContactReason($contactReason){
        return $this->setData(self::CONTACT_REASON, $contactReason);
    }
    /**
     * Get Files.
     *
     * @return varchar
     */
    public function getFiles(){
        return $this->getData(self::FILES);
    }
    /**
     * Set Files.
     */
    public function setFiles($files){
        return $this->setData(self::FILES, $files);
    }
    /**
     * Get Explanation
     *
     * @return varchar
     */
    public function getExplanation(){
        return $this->getData(self::EXPLANATION);
    }
    /**
     * Set Explanation.
     */
    public function setExplanation($explanation){
        return $this->setData(self::EXPLANATION, $explanation);
    }
    /**
     * Get Warranty.
     *
     * @return integer
     */
    public function getWarranty(){
        return $this->getData(self::WARRANTY);
    }
    /**
     * Set Warranty.
     */
    public function setWarranty($warranty){
        return $this->setData(self::WARRANTY, $warranty);
    }
    /**
     * Get ProblemDescription.
     *
     * @return varchar
     */
    public function getProblemDescription(){
        return $this->getData(self::PROBLEM_DESCRIPTION);
    }
    /**
     * Set ProblemDescription.
     */
    public function setProblemDescription($problemDescription){
        return $this->setData(self::PROBLEM_DESCRIPTION, $problemDescription);
    }
    /**
     * Get WhatRequired.
     *
     * @return integer
     */
    public function getWhatRequired(){
        return $this->getData(self::WHAT_REQUIRED);
    }

    /**
     * Set Warranty.
     */
    public function setWhatRequired($whatRequired){
        return $this->setData(self::WHAT_REQUIRED, $whatRequired);
    }

    /**
     * Get Paragraph.
     *
     * @return varchar
     */
    public function getParagraph(){
        return $this->getData(self::PARAGRAPH);
    }

    /**
     * Set Paragraph.
     */
    public function setParagraph($paragraph){
        return $this->setData(self::PARAGRAPH, $paragraph);
    }
    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}