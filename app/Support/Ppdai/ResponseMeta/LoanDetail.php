<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace App\Support\Ppdai\Response;




class LoanDetail
{
    public $fistBidTime;
    public $lastBidTime;
    public $lenderCount;
    public $auditingTime;
    public $remainFunding;
    public $deadLineTimeOrRemindTimeStr;
    public $creditCode;
    public $listingId;
    public $amount;
    public $months;
    public $currentRate;
    public $borrowName;
    public $gender;
    public $educationDegree;
    public $graduateSchool;
    public $studyStyle;
    public $age;
    public $successCount;
    public $wasteCount;
    public $cancelCount;
    public $failedCount;
    public $normalCount;
    public $overdueLessCount;
    public $overdueMoreCount;
    public $owingPrincipal;
    public $owingAmount;
    public $amountToReceive;
    public $firstSuccessBorrowTime;
    public $lastSuccessBorrowTime;
    public $registerTime;
    public $certificateValidate;
    public $nciicIdentityCheck;
    public $phoneValidate;
    public $videoValidate;
    public $creditValidate;
    public $educateValidate;
    public $highestPrincipal;
    public $highestDebt;
    public $totalPrincipal;

    public static function createList(array $dataList){
        $instanceList = array();
        foreach ($dataList as $item){
            $instanceList[] = self::create($item);
        }
        return collect($instanceList);
    }

    public static function create(array $data){
        $instance = new self();
        $instance->fistBidTime = $data['FistBidTime'];
        $instance->lastBidTime = $data['LastBidTime'];
        $instance->lenderCount = $data['LenderCount'];
        $instance->auditingTime = $data['AuditingTime'];
        $instance->remainFunding = $data['RemainFunding'];
        $instance->deadLineTimeOrRemindTimeStr = $data['DeadLineTimeOrRemindTimeStr'];
        $instance->creditCode = $data['CreditCode'];
        $instance->listingId = $data['ListingId'];
        $instance->amount = $data['Amount'];
        $instance->months = $data['Months'];
        $instance->currentRate = $data['CurrentRate'];
        $instance->borrowName = $data['BorrowName'];
        $instance->gender = $data['Gender'];
        $instance->educationDegree = $data['EducationDegree'];
        $instance->graduateSchool = $data['GraduateSchool'];
        $instance->studyStyle = $data['StudyStyle'];
        $instance->age = $data['Age'];
        $instance->successCount = $data['SuccessCount'];
        $instance->wasteCount = $data['WasteCount'];
        $instance->cancelCount = $data['CancelCount'];
        $instance->failedCount = $data['FailedCount'];
        $instance->normalCount = $data['NormalCount'];
        $instance->overdueLessCount = $data['OverdueLessCount'];
        $instance->overdueMoreCount = $data['OverdueMoreCount'];
        $instance->owingPrincipal = $data['OwingPrincipal'];
        $instance->owingAmount = $data['OwingAmount'];
        $instance->amountToReceive = $data['AmountToReceive'];
        $instance->firstSuccessBorrowTime = $data['FirstSuccessBorrowTime'];
        $instance->lastSuccessBorrowTime = $data['LastSuccessBorrowTime'];
        $instance->registerTime = $data['RegisterTime'];
        $instance->certificateValidate = $data['CertificateValidate'];
        $instance->nciicIdentityCheck = $data['NciicIdentityCheck'];
        $instance->phoneValidate = $data['PhoneValidate'];
        $instance->videoValidate = $data['VideoValidate'];
        $instance->creditValidate = $data['CreditValidate'];
        $instance->educateValidate = $data['EducateValidate'];
        $instance->highestPrincipal = $data['HighestPrincipal'];
        $instance->highestDebt = $data['HighestDebt'];
        $instance->totalPrincipal = $data['TotalPrincipal'];
        return $instance;
    }

}