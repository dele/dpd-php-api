<pre>
<?php
require_once __DIR__.'/dpd_required.php';

$shipFromDpd["Company"] = "FromCompanyName";
$shipFromDpd["Name"] = "my@example.com";
$shipFromDpd["Street"] = "Street, Number/Number";
$shipFromDpd["City"] = "City";
$shipFromDpd["PostalCode"] = "58124";
$shipFromDpd["CountryCode"] = "PL";
$shipFromDpd["Phone"] = "12121212";
$shipFromDpd["Email"] = "my@example.com";

$shipToDpd["Company"] = 'ToCompanyName';
$shipToDpd["Name"] = 'PersonName';
$shipToDpd["Surname"] = 'PersonSurname';
$shipToDpd["Street"] = 'Hegelallee';
$shipToDpd["Number"] = '1';
$shipToDpd["City"] = 'Potsdam';
$shipToDpd["CountryCode"] = 'DE';
$shipToDpd["PostalCode"] = '14467';
$shipToDpd["Phone"] = '123123123';
$shipToDpd["Phone2"] = '33221144';
$shipToDpd["Email"] = 'you@example.com';

$packageDetails["package_amount"] = 1;
$packageDetails["customer_data_1"] = 'SomeExtraInfo';
$packageDetails["package_content"] = uniqid();
$packageDetails["reference_number"] = uniqid();
$packageDetails["Ref1"] = 'reference_1';
$packageDetails["Ref2"] = 'reference_2';
$packageDetails["Ref3"] = 'reference_3';
$packageDetails["COD"] = '0';
$packageDetails["DeclaredValue"] =  '0';
$packageDetails["Weight"] = '11';

try{
    $dpd = new DpdApi();
    $dpd->setLang("en_EN");
    
    //webservice host (xml) - ask Your DPD consultant
    $dpd->setHost("https://dpdservicesdemo.dpd.com.pl/DPDPackageXmlServicesService/DPDPackageXmlServices?wsdl");
    $dpd->setFolder(__DIR__.'/files');
    $dpd->setLogin("test");
    $dpd->setPassword("KqvsoFLT2M");
    $dpd->setMasterfid(1495);
    
    $dpd->setDepartment(1);
    $dpd->setConnection();
    $dpd->setShipFrom($shipFromDpd);
    $dpd->setShipTo($shipToDpd);
    $dpd->setPackageDetails($packageDetails);

    //register package
	//print_r($dpd->registerNewPackage());
    
    //get label by reference number
	var_dump($dpd->getLabelPDF(1, "54DB5C2B9B112"));
    
    //get label by waybill number
    //var_dump($dpd->getLabelPDF(2, "13189300000135"));
    
    //generate protocol
    //var_dump($dpd->getProtocol(array('EXAMPLE_REFERENCE_NUMBER')));
    
    
}catch (Exception $e){
    var_dump($e->getMessage());
}

?>