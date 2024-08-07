<?php
include_once("connection/PDOModel.php");
@session_start();
class EmployeeModel{
    function requestId($type,$formType,$idNumber,$email,$fname,$mdname,$lname,$nameExt,$academicRank,$plantillaPos,$designation,$resAddress,$DoB,$contact,$civilStatus,$bloodType,$emgfname,$emgMname,$emgLname,$emgNameExt,$emgAddress,$emgContact,$photo,$signature,$hrmoScanned,$hrmoNew,$aol) {
        $conn = new PDOModel();
        $db = $conn->getDb();

        try {
            // Prepare the SQL statement
            $stmt = $db->prepare("
                INSERT INTO 
                clients (clientType, formType, email, firstName, middleName, lastName, nameExt, emergencyFirstName, emergencyMiddleName, emergencyLastName, emergencyNameExt, emergencyAddress, emergencyContactNum, clientSignature, clientPhoto)
                VALUES (:clientType, :formType, :email, :firstName, :middleName, :lastName, :nameExt, :emergencyfname, :emergencymname, :emergencylname, :emergencyNameExt, :emergencyaddress, :emergencycontact, :signature, :photo)
            ");

            // Bind the parameters
            $stmt->bindParam(':clientType', $type);
            $stmt->bindParam(':formType', $formType);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':firstName', $fname);
            $stmt->bindParam(':middleName', $mdname);
            $stmt->bindParam(':lastName', $lname);
            $stmt->bindParam(':nameExt', $nameExt);
            $stmt->bindParam(':emergencyfname', $emgfname);
            $stmt->bindParam(':emergencymname', $emgMname);
            $stmt->bindParam(':emergencylname', $emgLname);
            $stmt->bindParam(':emergencyNameExt', $emgNameExt);
            $stmt->bindParam(':emergencyaddress', $emgAddress);
            $stmt->bindParam(':emergencycontact', $emgContact);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':signature', $signature);

            // Execute the statement
            $stmt->execute();

            // Optionally, you can return the ID of the inserted row
            // variable res as lastinsertid
            $res = $db->lastInsertId();
            if($res){
                $stmt1 = $db->prepare("
                    INSERT INTO 
                    employee (clientIDEmp, empNum, academicRank, plantillaPos, designation, residentialAddress, birthDate, contactNum, civilStatus, bloodType, hrmoScanned, hrmoNew, affidavitOfLoss) 
                    VALUES (:clientIDEmp, :idNumber, :academicRank, :plantillaPos, :designation, :residentialAddress, :birthDate, :contactNum, :civilStatus, :bloodType, :hrmoScanned, :hrmoNew, :aol)
                ");
                $stmt1->bindParam(':clientIDEmp', $res);
                $stmt1->bindParam(':idNumber', $idNumber);
                $stmt1->bindParam(':academicRank', $academicRank);
                $stmt1->bindParam(':plantillaPos', $plantillaPos);
                $stmt1->bindParam(':designation', $designation);
                $stmt1->bindParam(':residentialAddress', $resAddress);
                $stmt1->bindParam(':birthDate', $DoB);
                $stmt1->bindParam(':contactNum', $contact);
                $stmt1->bindParam(':civilStatus', $civilStatus);
                $stmt1->bindParam(':bloodType', $bloodType);
                $stmt1->bindParam(':hrmoScanned', $hrmoScanned);
                $stmt1->bindParam(':hrmoNew', $hrmoNew);
                $stmt1->bindParam(':aol', $aol);

                $stmt1->execute();
                return $db->lastInsertId();
            }
            

        } catch (PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function updateEmploy($id,$type,$formType,$idNumber,$email,$fname,$mdname,$lname,$nameExt,$academicRank,$plantillaPos,$designation,$resAddress,$DoB,$contact,$civilStatus,$bloodType,$emgfname,$emgMname,$emgLname,$emgNameExt,$emgAddress,$emgContact,$photo,$signature,$hrmoScanned,$hrmoNew,$aol) {
        $conn = new PDOModel();
        $db = $conn->getDb();

        try {
            // Prepare the SQL statement
            $stmt = $db->prepare("
                UPDATE clients SET 
                clientType = :clientType, formType = :formType, email = :email, firstName = :firstName, middleName = :middleName, 
                lastName = :lastName, nameExt = :nameExt, emergencyFirstName = :emergencyfname, emergencyMiddleName = :emergencymname, 
                emergencyLastName = :emergencylname, emergencyNameExt = :emergencyNameExt, emergencyAddress = :emergencyaddress, 
                emergencyContactNum = :emergencycontact, clientSignature = :signature, clientPhoto = :photo 
                WHERE id = :id
            ");

            // Bind the parameters
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(':clientType', $type);
            $stmt->bindParam(':formType', $formType);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':firstName', $fname);
            $stmt->bindParam(':middleName', $mdname);
            $stmt->bindParam(':lastName', $lname);
            $stmt->bindParam(':nameExt', $nameExt);
            $stmt->bindParam(':emergencyfname', $emgfname);
            $stmt->bindParam(':emergencymname', $emgMname);
            $stmt->bindParam(':emergencylname', $emgLname);
            $stmt->bindParam(':emergencyNameExt', $emgNameExt);
            $stmt->bindParam(':emergencyaddress', $emgAddress);
            $stmt->bindParam(':emergencycontact', $emgContact);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':signature', $signature);

            // Execute the statement
            $stmt->execute();

            // Optionally, you can return the ID of the inserted row
            // variable res as lastinsertid
            $res = $id;
            if($res){
                $stmt1 = $db->prepare("
                UPDATE employee SET 
                empNum = :idNumber, academicRank = :academicRank, plantillaPos = :plantillaPos, designation = :designation, 
                residentialAddress = :residentialAddress, birthDate = :birthDate, contactNum = :contactNum, civilStatus = :civilStatus, 
                bloodType = :bloodType, hrmoScanned = :hrmoScanned, hrmoNew = :hrmoNew, affidavitOfLoss = :aol 
                WHERE clientIDEmp = :clientIDEmp
                ");
                $stmt1->bindParam(':clientIDEmp', $res);
                $stmt1->bindParam(':idNumber', $idNumber);
                $stmt1->bindParam(':academicRank', $academicRank);
                $stmt1->bindParam(':plantillaPos', $plantillaPos);
                $stmt1->bindParam(':designation', $designation);
                $stmt1->bindParam(':residentialAddress', $resAddress);
                $stmt1->bindParam(':birthDate', $DoB);
                $stmt1->bindParam(':contactNum', $contact);
                $stmt1->bindParam(':civilStatus', $civilStatus);
                $stmt1->bindParam(':bloodType', $bloodType);
                $stmt1->bindParam(':hrmoScanned', $hrmoScanned);
                $stmt1->bindParam(':hrmoNew', $hrmoNew);
                $stmt1->bindParam(':aol', $aol);

                $stmt1->execute();
                return $res;
            }
            

        } catch (PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}