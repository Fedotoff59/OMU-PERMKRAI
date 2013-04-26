<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- steps-list -->
<ul class="services">
<?
    $i = 0;
    foreach($arResult as $sID => $arSectionData)
    {
        $i++;
?>
    <li class="item<?=$i?>"><a href="#"><?=$arSectionData['SECTION_NAME'];?></a>
          <div class="drop">  
            <ul>
                <?
                foreach($arSectionData['ELEMENTS'] as $elID => $elName)
                    {
                ?>
                        <li><a href="services/<?=$elID;?>/<?=$arParams['LOCATION_ALIAS'];?>"><?=$elName;?></a></li>
                <?  }   ?>
            </ul>
            <span class="arrow"></span>
          </div>
    </li>
<?  } ?>
</ul>


