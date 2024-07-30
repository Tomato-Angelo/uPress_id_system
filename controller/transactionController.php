<?php
include_once("model/studModel.php");
include_once("model/empModel.php");
include_once("model/transactionManageModel.php");
$Stud = new StudentModel();
$Employ = new EmployeeModel();
$clients = new TransactionManageModel();

$uploadedFiles = array();
$uploadedFiles['userPhoto'] = array();
$uploadedFiles['signature'] = array();
$uploadedFiles['cor']= array();
$uploadedFiles['oldId'] = array();
$uploadedFiles['oldIdBack'] = array();
$uploadedFiles['aol'] = array();
$uploadedFiles['DSAForm'] = array();
$uploadedFiles['hrmoScanned'] = array();
$uploadedFiles['hrmoNew'] = array();

if(isset($_POST["submitType"])){
    switch($_POST["submitType"]) {
        case 'addStud':
            handleAddStud($Stud);
        break;
        case 'updateStud':
            handleUpdateStud($Stud);
        break;
        case 'addEmploy':
            handleAddEmploy($Employ);
            break;
        case 'updateEmploy':
            handleUpdateEmploy($Employ);
            break;
        case 'viewClients':
            handleViewClients($_POST["clientID"],$clients);
            break;
        case 'updateStatus':
            handleStatus($clients);
            break;
        case 'delete':
            handleDeleteClient($clients);
            break;
    }
}
function handleStatus($updatedStatus){
    $id = $_POST['id'];

    $update = $updatedStatus->changeStatus($id);
    if($update){
        echo json_encode(['message'=>'Status updated successfully','status'=>'success']);
    } else {
        echo json_encode(['message'=>'Status was not changed','status'=>'error']);
    }
}
function handleAddStud($objModel){
    // var_dump($objModel);
    $type = $_POST["clientType"];
    $formtype = $_POST["formType"] ? $_POST["formType"] : '';
    //var_dump($formtype);
    $studId = $_POST["studnum"];
    $email = $_POST["email"];
    $firstname = $_POST["firstName"];
    $middlename = $_POST["middleName"];
    $familyname = $_POST["familyName"];
    $nameExt = $_POST["nameExt"];
    $program = $_POST["programs"];
    $emgfname = $_POST["firstNameEmg"];
    $emgMname = $_POST["middleNameEmg"];
    $emgLname = $_POST["familyNameEmg"];
    $emgNameExt = $_POST["nameExtEmg"];
    $emgAddress = $_POST["address"];
    $emgContact = $_POST["contactNumber"];

    uploadImage('userPhoto','student/pictures');
    uploadImage('signature','student/pictures');
    uploadImage('cor','student/files');
    uploadImage('oldId','student/files');
    uploadImage('oldIdBack','student/files');
    uploadImage('aol','student/files');
    uploadImage('DSAForm','student/files');
    
    global $uploadedFiles;
    $photo = !empty($uploadedFiles['userPhoto'][0]) ? $uploadedFiles['userPhoto'][0]:"";
    $signature = !empty($uploadedFiles['signature'][0]) ? $uploadedFiles['signature'][0]:"";
    $cor = !empty($uploadedFiles['cor'][0]) ? $uploadedFiles['cor'][0]:"";
    $oldId = !empty($uploadedFiles['oldId'][0]) ? $uploadedFiles['oldId'][0]:"";
    $oldIdBack = !empty($uploadedFiles['oldIdBack'][0]) ? $uploadedFiles['oldIdBack'][0]:"";
    $aol =!empty($uploadedFiles['aol'][0]) ? $uploadedFiles['aol'][0]:"";
    $DSAForm =!empty($uploadedFiles['DSAForm'][0]) ? $uploadedFiles['DSAForm'][0]:"";


    $res1 = $objModel->requestId(
        $type, $formtype, $studId, $email, $firstname, $middlename, $familyname, $nameExt,
            $program, $emgfname, $emgMname, $emgLname, $emgNameExt, $emgAddress, $emgContact, $photo, $signature, $cor, $oldId, $oldIdBack, $aol, $DSAForm
    );
    if ($res1) {
        echo json_encode(['message'=>'Successfully added '.$firstname.' '.$familyname,'status'=>'success']);
    } else {
        echo json_encode(['message'=>'Failed to add'.$firstname.' '.$familyname,'status'=>'error']);
    }

}
function handleUpdateStud($objModel){
    // var_dump($objModel);
    $type = $_POST["clientType"];
    $formtype = $_POST["formType"]? $_POST["formType"] : '';
    $studId = $_POST["studnum"];
    $email = $_POST["email"];
    $firstname = $_POST["firstName"];
    $middlename = $_POST["middleName"];
    $familyname = $_POST["familyName"];
    $nameExt = $_POST["nameExt"];
    $program = $_POST["programs"];
    $emgfname = $_POST["firstNameEmg"];
    $emgMname = $_POST["middleNameEmg"];
    $emgLname = $_POST["familyNameEmg"];
    $emgNameExt = $_POST["nameExtEmg"];
    $emgAddress = $_POST["address"];
    $emgContact = $_POST["contactNumber"];
    
    global $uploadedFiles;
    uploadImage('userPhoto','student/pictures');
    uploadImage('signature','student/pictures');
    uploadImage('cor','student/files');
    uploadImage('oldId','student/files');
    uploadImage('oldIdBack','student/files');
    uploadImage('aol','student/files');
    uploadImage('DSAForm','student/files');
    
    $photo = !empty($uploadedFiles['userPhoto'][0]) ? $uploadedFiles['userPhoto'][0]:"";
    $signature = !empty($uploadedFiles['signature'][0]) ? $uploadedFiles['signature'][0]:"";
    $cor = !empty($uploadedFiles['cor'][0]) ? $uploadedFiles['cor'][0]:"";
    $oldId = !empty($uploadedFiles['oldId'][0]) ? $uploadedFiles['oldId'][0]:"";
    $oldIdBack = !empty($uploadedFiles['oldIdBack'][0]) ? $uploadedFiles['oldIdBack'][0]:"";
    $aol =!empty($uploadedFiles['aol'][0]) ? $uploadedFiles['aol'][0]:"";
    $DSAForm =!empty($uploadedFiles['DSAForm'][0]) ? $uploadedFiles['DSAForm'][0]:"";
    
    $id = $_POST["id"];
    
    $res1 = $objModel->updateStudent($id,
        $type, $formtype, $studId, $email, $firstname, $middlename, $familyname, $nameExt,
            $program, $emgfname, $emgMname, $emgLname, $emgNameExt, $emgAddress, $emgContact, $photo, $signature, $cor, $oldId, $oldIdBack, $aol, $DSAForm
    );
    if ($res1) {
        echo json_encode(['message'=>'Successfully updated '.$firstname.' '.$familyname, 'status'=>'success']);
    } else {
        echo json_encode(['message'=>'Failed to update '.$firstname.' '.$familyname, 'status'=>'error']);
    }

}
function handleAddEmploy($objModel){
    // var_dump($objModel);
    $type = $_POST["clientType"];
    $formType = $_POST["formType"] ? $_POST["formType"] : '';
    $idNumber = $_POST["idNumber"];
    $email = $_POST["email"];
    $firstname = $_POST["firstName"];
    $middlename = $_POST["middleName"];
    $familyname = $_POST["familyName"];
    $nameExt = $_POST["nameExt"];
    $academicRank = $_POST["academicRank"];
    $plantillaPos = $_POST["plantillaPos"];
    $designation = $_POST["designation"];
    $residentialAddress = $_POST["residentialAddress"];
    $dateofbirth = $_POST["dateofbirth"];
    $contactNum = $_POST["contactNum"];
    $civilStatus = $_POST["civilStatus"];
    $bloodType = $_POST["bloodType"];
    $emgfname = $_POST["firstNameEmg"];
    $emgMname = $_POST["middleNameEmg"];
    $emgLname = $_POST["familyNameEmg"];
    $emgNameExt = $_POST["nameExtEmg"];
    $emgAddress = $_POST["address"];
    $emgContact = $_POST["contactNumber"];

    uploadImage('userPhoto','employee/pictures');
    uploadImage('signature','employee/pictures');
    uploadImage('hrmoScanned','employee/files');
    uploadImage('hrmoNew','employee/files');
    uploadImage('aol','employee/files');
    
    global $uploadedFiles;
    $photo = !empty($uploadedFiles['userPhoto'][0]) ? $uploadedFiles['userPhoto'][0]:"";
    $signature = !empty($uploadedFiles['signature'][0]) ? $uploadedFiles['signature'][0]:"";
    $hrmoScanned = !empty($uploadedFiles['hrmoScanned'][0]) ? $uploadedFiles['hrmoScanned'][0]:"";
    $hrmoNew = !empty($uploadedFiles['hrmoNew'][0]) ? $uploadedFiles['hrmoNew'][0]:"";
    $aol =!empty($uploadedFiles['aol'][0]) ? $uploadedFiles['aol'][0]:"";

    $res1 = $objModel->requestId(
        $type, $formType, $idNumber, $email, $firstname, $middlename, $familyname, $nameExt,
            $academicRank, $plantillaPos, $designation, $residentialAddress, $dateofbirth, $contactNum, $civilStatus, $bloodType,
            $emgfname, $emgMname, $emgLname, $emgNameExt, $emgAddress, $emgContact, $photo, $signature, $hrmoScanned, $hrmoNew, $aol
    );
    if ($res1) {
        echo json_encode(['message'=>"Successfully added ".$firstname.' '.$familyname,'status'=>'success']);
    } else {
        echo json_encode(['message'=>"Failed to add ".$firstname.' '.$familyname,'status'=>'error']);
    }

}

function handleUpdateEmploy($objModel){
    $type = $_POST["clientType"];
    $formType = $_POST["formType"]? $_POST["formType"] : '';
    $idNumber = $_POST["idNumber"];
    $email = $_POST["email"];
    $firstname = $_POST["firstName"];
    $middlename = $_POST["middleName"];
    $familyname = $_POST["familyName"];
    $nameExt = $_POST["nameExt"];
    $academicRank = $_POST["academicRank"];
    $plantillaPos = $_POST["plantillaPos"];
    $designation = $_POST["designation"];
    $residentialAddress = $_POST["residentialAddress"];
    $dateofbirth = $_POST["dateofbirth"];
    $contactNum = $_POST["contactNum"];
    $civilStatus = $_POST["civilStatus"];
    $bloodType = $_POST["bloodType"];   
    $emgfname = $_POST["firstNameEmg"];
    $emgMname = $_POST["middleNameEmg"];
    $emgLname = $_POST["familyNameEmg"];
    $emgNameExt = $_POST["nameExtEmg"];
    $emgAddress = $_POST["address"];
    $emgContact = $_POST["contactNumber"];
    
    uploadImage('userPhoto','employee/pictures');
    uploadImage('signature','employee/pictures');
    uploadImage('hrmoScanned','employee/files');
    uploadImage('hrmoNew','employee/files');
    uploadImage('aol','employee/files');
    
    global $uploadedFiles;
    $photo = !empty($uploadedFiles['userPhoto'][0]) ? $uploadedFiles['userPhoto'][0]:"";
    $signature = !empty($uploadedFiles['signature'][0]) ? $uploadedFiles['signature'][0]:"";
    $hrmoScanned = !empty($uploadedFiles['hrmoScanned'][0]) ? $uploadedFiles['hrmoScanned'][0]:"";
    $hrmoNew = !empty($uploadedFiles['hrmoNew'][0]) ? $uploadedFiles['hrmoNew'][0]:"";
    $aol =!empty($uploadedFiles['aol'][0]) ? $uploadedFiles['aol'][0]:"";

    $id = $_POST["id"];

    $res1 = $objModel->updateEmploy(
        $id,$type, $formType, $idNumber, $email, $firstname, $middlename, $familyname, $nameExt,
            $academicRank, $plantillaPos, $designation, $residentialAddress, $dateofbirth, $contactNum, $civilStatus, $bloodType,
            $emgfname, $emgMname, $emgLname, $emgNameExt, $emgAddress, $emgContact, $photo, $signature, $hrmoScanned, $hrmoNew, $aol
    );
    if ($res1) {
        echo json_encode(['message'=>"Successfully updated ".$firstname.' '.$familyname,'status'=>'success']);
    } else {
        echo json_encode(['message'=>"Failed to update ".$firstname.' '.$familyname,'status'=>'error']);
    }
}

function handleViewClients($id,$objModel){
    $result = $objModel->getAccountById($id);
    if($result){
        echo json_encode($result);
    }

}

function handleDeleteClient($objModel) {
    $id = $_POST['id'];
    $deleteAcc = $objModel->softDeleteClient($id);
    if($deleteAcc){
        echo json_encode(['message'=>'Successfully deleted client '.$id,'status'=>'success']);
    } else {
        echo json_encode(['message'=>'Failed to delete client'.$id,'status'=>'error']);
    }
}

function uploadImage($fieldName,$folder) {
    $errors = array();
    global $uploadedFiles;
    
    $allowedExtensions = array("jpeg", "jpg", "png", "gif");
    foreach ($_FILES as $fileKey => $fileArray) {
        if (isset($fileArray)) {
            foreach ($fileArray['tmp_name'] as $key => $tmp_name) {
                $file_name = $fileArray['name'][$key];
                $file_tmp = $fileArray['tmp_name'][$key];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                if (!in_array($ext, $allowedExtensions)) {
                    $errors[] = "Extension not allowed for $file_name, please choose a JPEG, JPG, PNG, or GIF file.";
                    continue;
                }

                $filename = basename($file_name, "." . $ext);
                $photoName = $filename . time() . "." . $ext;
                $uploadPath = "uploads/".$folder."/" . $photoName;

                if (move_uploaded_file($file_tmp, $uploadPath)) {
                    $uploadedFiles[$fileKey][] = $photoName;
                } else {
                    $errors[] = "Failed to upload $file_name.";
                }
            }
        }
    }

    if (!empty($errors)) {
        return false; 
    }
    
    return $uploadedFiles[$fieldName][0] ?? false;
}

function getUploadPath($fileKey) {
    $uploadPaths = [
        "accountPhoto" => "account",
        "userPhoto" => "student",
        "signature" => "student",
        "cor" => "student",
        "oldId" => "student",
        "oldIdBack" => "student",
        "aol" => "student"
    ];
    return $uploadPaths[$fileKey] ?? "other";
}
?>