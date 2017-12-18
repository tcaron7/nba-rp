<?php   
    include('controller/season/generateSeasonSchedule.php');
    $valid = updatePlayerAtSeasonEnd();
    $teams = getAllTeamOrderByName();
    foreach($teams as $team)
    {
        $idRound1 = checkDraftPickExistence($team->getId(), $currentSeason+1, 1);
        if(empty($idRound1))
        {
            insertDraftPick($currentSeason+1, 1, $team->getId());
        }
        $idRound2 = checkDraftPickExistence($team->getId(), $currentSeason+1, 2);
        if(empty($idRound2))
        {
            insertDraftPick($currentSeason+1, 2, $team->getId());
        }
    }
    
    $oldProspects = getDraftPromotionByYear($currentSeason);
    $i = 0;
    foreach($oldProspects as $oldProspect)
    {
        $draftPosition = getDraftPositionOfGivenProspectInGivenDraft($oldProspect->getId(), $currentSeason);
        
        $newPlayer = new Player(0);
        $newPlayer->setBirthdate($oldProspect->getBirthdate());

        $newPlayer->setFirstname($oldProspect->getFirstname());
        $newPlayer->setName($oldProspect->getName());
        $newPlayer->setNationality($oldProspect->getNationality());
        $newPlayer->setFormation($oldProspect->getFormation());
        $newPlayer->setHeight($oldProspect->getHeight());
        $newPlayer->setWeight($oldProspect->getWeight());
        
        $newPlayer->setTeamId($draftPosition->getCurrentOwnerTeam()->getId());
        $newPlayer->setPosition($oldProspect->getPosition());
        $newPlayer->setSalary(0);
        $newPlayer->setGuarantedYear(0);
        $newPlayer->setOptionalYear(0);
        $newPlayer->setContractType('');
        $newPlayer->setExperience(0);
        $newPlayer->setDraftPromotion($currentSeason);
        $newPlayer->setTeamId($draftPosition->getCurrentOwnerTeam()->getId());
        $newPlayer->setDraftPosition($draftPosition->getGlobalDraftPick());
        
        $personId = $oldProspect->getPersonId();
        $id = insertPlayer($newPlayer, $personId);

    }
?>