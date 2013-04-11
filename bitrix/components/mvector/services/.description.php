<? 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("Оценка услуг"),
"DESCRIPTION" => GetMessage("Общий компонент"),
"PATH" => array(
"ID" => "mv_components",
"CHILD" => array(
"ID" => "services",
"NAME" => "Оценка муниципальных услуг")
)
);
?>