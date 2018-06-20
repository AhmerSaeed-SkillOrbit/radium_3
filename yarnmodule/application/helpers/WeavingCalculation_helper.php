<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WeavingCalculationHelper
 *
 * @author Zeeshan Khalil
 */
class WeavingCalculationHelper {
    
    const THREEDECIMALPLACES = 3;
    const TWODECIMALPLACES = 2;
    
    public static function CalculateConsumedWeight($weight, $weightUnits, $weavingLossPercent, $processLossPercent) {
        $weightInLbs = 0.000;
        $finishWeight = 0.000;
        $cosumedWeight = 0.000;
        $totalLossPercent = 0.000;
        
        if ($weightUnits == "kgs") {
            $weightInLbs = self::ConvertKgsToLbs($weight);            
        }
        
        $finishWeight = self::CalculateFinishWeight($weightInLbs);
        $totalLossPercent = ($weavingLossPercent / 100) + ($processLossPercent / 100);
        $weightLoss = $totalLossPercent * $finishWeight;
        $cosumedWeight = $finishWeight + $weightLoss; 
        $cosumedWeight = round($cosumedWeight, self::THREEDECIMALPLACES);
        return $cosumedWeight;
    }
    
    public static function CalculateAllowedConsumption($totalPieces, $averageFinishWeight=1, $averageFinishWeightUnits, $weavingLossPercent, $processLossPercent){
        $totalDozen = 0.00;
        $weightPieces = 0.00;
//        die($averageFinishWeight);
        $totalLossPercent = ($weavingLossPercent / 100) + ($processLossPercent / 100);
        
        if ($averageFinishWeightUnits == "onz/doz"){
            $averageFinishWeight = self::ConvertOnzToLbs($averageFinishWeight); 
        }
        
        if($averageFinishWeightUnits == "lbs/doz" || $averageFinishWeightUnits == "onz/doz") {
            $totalDozen = self::ConvertPcsToDozens($totalPieces);
            
            $weightPieces = floatval($totalDozen) * floatval($averageFinishWeight);
            $weightLoss = floatval($weightPieces) * floatval($totalLossPercent);
            $consumption = floatval($weightPieces) + floatval($weightLoss);
        }
        else if("gm/pc") {
            $weightPieces = floatval($totalPieces) * floatval($averageFinishWeight);
            $weightLoss = floatval($weightPieces) * floatval($totalLossPercent);
            $consumption = floatval($weightPieces) + floatval($weightLoss);
        }
        //die($consumption);
        $consumption = round($consumption, self::TWODECIMALPLACES);
        return $consumption;
    }
    
    public static function CalculateAverageFinishWeight($weight, $weightUnits, $finishWeightUnits, $totalPieces) {
        $avgFinishWeight = 0.000;
        
        if ($weightUnits == "kgs" && $finishWeightUnits == "gm/pc") {
            $weightIngms = self::ConvertKgsToGrams($weight); 
            $greighWeightIngms = self::CalculateFinishWeight($weightIngms);
            $avgFinishWeight = $greighWeightIngms / $totalPieces;
        }
        else if ($weightUnits == "kgs" && ($finishWeightUnits == "lbs/doz" || $finishWeightUnits == "onz/doz")) {
            $weightInLbs= self::ConvertKgsToLbs($weight); 
            $greighWeightInLbs = self::CalculateFinishWeight($weightInLbs);
            $totalDozen = self::ConvertPcsToDozens($totalPieces);
            $avgFinishWeight = $greighWeightInLbs / $totalDozen;
        }
        $avgFinishWeight = round($avgFinishWeight, self::THREEDECIMALPLACES);
        return $avgFinishWeight;        
    }
    
    public static function CalculateHeavyLightPercent($weightRequired, $weightReceived) {
        $percent = (($weightReceived / $weightRequired) * 100) - 100;
        $percent = round($percent, self::THREEDECIMALPLACES);
        return $percent;
    }
    
    public static function CalculateFinishWeight($weight = 0.000) {
        return $weight / 1.07;
    }

    public static function ConvertKgsToLbs($weightInKgs = 0.000) {
        return $weightInKgs * 2.2046;
    }
    
    public static function ConvertKgsToGrams($weightInKgs = 0.000) {
        return $weightInKgs * 1000;
    }
    
    public static function  ConvertOnzToLbs($weightInOnz = 0.000) {
        return $weightInOnz / 16;
    }

    public static function ConvertPcsToDozens($totalPcs = 0) {
        return $totalPcs / 12;
    }
    
    public static function CalculateCountConsumption($countPercent, $consumedWeight){
        $countPercent = $countPercent / 100;
        $countWeight = $countPercent * $consumedWeight;
        $countWeight = round($countWeight, self::TWODECIMALPLACES);
        return $countWeight;
    }
       
}
