<?php
/**
 * Grid GridInterface.
 */
namespace Fantronix\ReturnOrder\Api\Data;
interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const EMAIL = 'email';
    const CONTACT_NUMBER = 'contact_number';
    const ADDRESS = 'address';
    const ORDER_NUMBER = 'order_number';
    const PURCHASE_DATE = 'purchase_date';
    const PRODUCT_DATA = 'product_data';
    const CONTACT_REASON = 'contact_reason';
    const FILES = 'files';
    const EXPLANATION = 'explanation';
    const WARRANTY = 'warranty';
    const PROBLEM_DESCRIPTION = 'problem_description';
    const WHAT_REQUIRED = 'what_required';
    const PARAGRAPH = 'paragraph';
    const CREATED_AT = 'created_at';
    /**
     * Get Id.
     *
     * @return int
     */
    public function getId();
    /**
     * Set Id.
     */
    public function setId($id);
    /**
     * Get Firstname.
     *
     * @return varchar
     */
    public function getFirstname();
    /**
     * Set Firstname.
     */
    public function setFirstname($firstname);
    /**
     * Get Lastname.
     *
     * @return varchar
     */
    public function getLastname();
    /**
     * Set Lastname.
     */
    public function setLastname($lastname);
    /**
     * Get Email.
     *
     * @return varchar
     */
    public function getEmail();
    /**
     * Set Email.
     */
    public function setEmail($email);
    /**
     * Get ContactNumber
     *
     * @return varchar
     */
    public function getContactNumber();
    /**
     * Set ContactNumber.
     */
    public function setContactNumber($contactNumber);
    /**
     * Get Address.
     *
     * @return varchar
     */
    public function getAddress();
    /**
     * Set Address.
     */
    public function setAddress($address);
    /**
     * Get OrderNumber.
     *
     * @return int
     */
    public function getOrderNumber();
    /**
     * Set OrderNumber.
     */
    public function setOrderNumber($orderNumber);
    /**
     * Get PurchaseDate.
     *
     * @return varchar
     */
    public function getPurchaseDate();
    /**
     * Set PurchaseDate.
     */
    public function setPurchaseDate($purchaseDate);
    /**
     * Get ProductData.
     *
     * @return date
     */
    public function getProductData();
    /**
     * Set ProductData.
     */
    public function setProductData($productData);
    /**
     * Get ContactReason.
     *
     * @return varchar
     */
    public function getContactReason();
    /**
     * Set ContactReason.
     */
    public function setContactReason($contactReason);
    /**
     * Get Files.
     *
     * @return varchar
     */
    public function getFiles();
    /**
     * Set Files.
     */
    public function setFiles($files);
    /**
     * Get Explanation
     *
     * @return varchar
     */
    public function getExplanation();
    /**
     * Set Explanation.
     */
    public function setExplanation($explanation);
    /**
     * Get Warranty.
     *
     * @return integer
     */
    public function getWarranty();
    /**
     * Set Warranty.
     */
    public function setWarranty($warranty);
    /**
     * Get ProblemDescription.
     *
     * @return varchar
     */
    public function getProblemDescription();
    /**
     * Set ProblemDescription.
     */
    public function setProblemDescription($problemDescription);
    /**
     * Get WhatRequired.
     *
     * @return integer
     */
    public function getWhatRequired();
    /**
     * Set Warranty.
     */
    public function setWhatRequired($whatRequired);
    /**
     * Get Paragraph.
     *
     * @return varchar
     */
    public function getParagraph();
    /**
     * Set Paragraph.
     */
    public function setParagraph($paragraph);
    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt();
    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt);
}