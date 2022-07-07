<?php

$name;
$skills; #explode skills
$tel; #if > 2 -> explode
$email;
$web;
$city;
$specialization;
$protocol;

?>


<div class="pt-5 align-items-center p-3 my-3 text-white-50 background-main-div rounded shadow-sm mr-5" style="max-width: 360px; min-width:360px; min-height:360px;">
          
    <div class="lh-1">
        <h5 class="mb-3 text-white lh-1"><? #name ?></h5>
        <ul class="text-white"> <!-- for cycle -->
            <li class="mb-1"><? #skill-1 ?></li>
            <li class="mb-1"><? #skill-2 ?></li>
            <li class="mb-1"><? #skill-3 ?></li>
            <li class="mb-1"><? #skill-4 ?></li>
        </ul>
        <hr>
        <p class="text-white">Kontakt:</p>
        <ul class="text-white">
            <li class="mb-1">tel: +420  <? #tel ?></li>
            <li class="mb-1">email: <? #email ?></li>
            <li class="mb-1">web: <? #link ?><a href="<? #protocol + #link ?>"></a></li>
        </ul>
    </div>

</div>