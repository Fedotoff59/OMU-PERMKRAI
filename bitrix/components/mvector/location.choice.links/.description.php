<? 
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("Перечень услуг"),
"DESCRIPTION" => GetMessage("Выводим перечень услуг по направлениям"),
"PATH" => array(
"ID" => "mv_components",
"CHILD" => array(
"ID" => "services_sections",
"NAME" => "Оценка муниципальных услуг")
)
);
?>