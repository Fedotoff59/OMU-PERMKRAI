<? 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("Форма оценки услуги"),
"DESCRIPTION" => GetMessage("Выводим форму оценки услуги"),
"PATH" => array(
"ID" => "mv_components",
"CHILD" => array(
"ID" => "services_sections",
"NAME" => "Оценка муниципальных услуг")
)
);
?>