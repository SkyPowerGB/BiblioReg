<?php

class Pagination
{


    private $maxPages;
    private $numOfbtns;
    private $startNuM = 1;
    private $currentPage;

    private $frontBtnNum;
    private $backBtnNum;

    private $recordsPerPage;

    function __construct($maxPages, $maxNumBtns, $recordsPerPage)
    {
        $this->recordsPerPage = $recordsPerPage;
        $this->maxPages = $maxPages;
        $this->currentPage = 0;
        $this->numOfbtns = $maxNumBtns;
        if ($maxNumBtns % 2 != 0) {
            $this->frontBtnNum = floor((int) $maxNumBtns / 2);
            $this->backBtnNum = floor((int) $maxNumBtns / 2);
        } else {
            $this->frontBtnNum = floor((int) $maxNumBtns / 2);
            $this->backBtnNum = $this->frontBtnNum - 1;

        }
    }
    /** @var Pagination $paginationO */
   private function generatePaginationLogic($paginationO)
    {

        if (isset($_POST["paginationPage"])) {
            $paginationO->setCurrPage($_POST["paginationPage"]);
        }



    }
    function setCurrPage($pageNum)
    {
        $this->currentPage = $pageNum;
    }
   

    private  function getNumOfPgBtns($front)
    {

        if ($front) {
            $distanceFront = $this->maxPages - $this->currentPage;

            if ($distanceFront - $this->frontBtnNum >= $this->frontBtnNum) {
                return $this->frontBtnNum;
            } else {
                return $distanceFront;
            }

        } else {
            $distBck = $this->currentPage;

            if ($distBck - $this->backBtnNum >= $this->backBtnNum) {
                return $this->backBtnNum;
            } else {
                return $distBck;
            }

        }
    }


    // data offsets for DB


    function getDataOffsetStart()
    {

        return ($this->currentPage - 1) * $this->recordsPerPage;
    }
    function getDataOffsetEnd()
    {
        return ($this->currentPage) * $this->recordsPerPage;
    }

   
     private $paginationContainerHorizontalClass="#";
     private $paginationContainerVerticalClass="#";
     private $paginationFormHorizontalClass="#";
     private $paginationFormVerticalClass="#";
     private $paginationCurrPgDivClass="#";
     private $paginationFLbtnsClass="#";


    function generatePaginatonButtonsHorizontal()
    {
        $this->generatePaginationButtonsV1(
            $this->paginationContainerHorizontalClass,
            $this->paginationFormHorizontalClass
        );
    }

    function generatePaginationButtonsVerticalV1(){
        $this->generatePaginationButtonsV1(
            $this->paginationContainerVerticalClass,
            $this->paginationFormVerticalClass
        );
    }
    

    function generatePaginationButtonsV1($paginationContainerClass,$paginationFormClass){

        $this->generatePaginationLogic($this);
        echo ("<div class=".$paginationContainerClass.">");

        echo ("<form class=".$paginationFormClass."  method=POST >");
        echo ("<button  class=".$this->paginationFLbtnsClass." name=paginationPage value=0>");
        echo ("Prva");
        echo ("</button>");
        echo ("</form>");

        for ($i = $this->getNumOfPgBtns(false); $i > 0; $i--) {
            echo ("<form class=".$paginationFormClass." method=POST >");
            echo ("<button name=paginationPage value=" . $this->currentPage - $i . ">");
            echo ($this->currentPage - $i);
            echo ("</button>");
            echo ("</form>");
        }
        echo ("<div class=".$this->paginationCurrPgDivClass.">");
        echo ($this->currentPage);
        echo ("</div>");

        for ($i = 1; $i <= $this->getNumOfPgBtns(true); $i++) {
            echo ("<form class=".$paginationFormClass." method=POST >");
            echo ("<button name=paginationPage value=" . $i + $this->currentPage . ">");
            echo ($i + $this->currentPage);
            echo ("</button>");
            echo ("</form>");
        }

        

        echo ("<form class=".$paginationFormClass." method=POST >");
        echo ("<button class=".$this->paginationFLbtnsClass." name=paginationPage value=" . $this->maxPages . ">");
        echo ("Zadnja");
        echo ("</button>");
        echo ("</form>");

        echo ("</div>");
    }



}