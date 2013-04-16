<?
/*
 * Базовый компонент формирования страницы с формой оценки услуги
 * Основные компоненты страницы подключаются в шаблоне
 */
$arResult = Array();

// Задаем имя формы для организации ajax взаимодействия
$arResult['CRITERIAS_FORM_ID'] = 'criteriasform';
 
$this->IncludeComponentTemplate();

echo '<pre>'; echo print_r($arParams); echo '</pre>'; 
?>