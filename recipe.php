<?php

$ingredients = get_field('ingredients');
$method = get_field('method');
$serves = get_field('serves');
$prep_time = get_field('prep_time');
$cook_time = get_field('cook_time');
$difficulty = get_field('difficulty');
?>

<div class="recipe">

    <div class="details">
        <div class="serves">
            <img class="nopin" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon-serves.svg" alt="">
            <span>SERVES <?php echo strtoupper($serves) ?></span>
        </div>

        <div class="time">
            <img class="nopin" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon-time.svg" alt="">
            <span>PREP:
                <span class="thin">
                <?php
                        $prep_time_string;

                        if ($prep_time['hours']) {
                            $prep_time_string .= $prep_time['hours'];

                            if ( intval($prep_time['hours']) === 1 ) {
                                $prep_time_string .= ' HR ';
                            } else {
                                $prep_time_string .= ' HRS ';
                            }
                        }

                        if ($prep_time['minutes']) {
                            $prep_time_string .= $prep_time['minutes'];
                            $prep_time_string .= ' MINS';
                        }

                        echo $prep_time_string;
                    ?>
                </span>
            </span>
            <span>COOK:
                <span class="thin">
                    <?php
                        $cook_time_string;

                        if ($cook_time['hours']) {
                            $cook_time_string .= $cook_time['hours'];

                            if ( intval($cook_time['hours']) === 1 ) {
                                $cook_time_string .= ' HR ';
                            } else {
                                $cook_time_string .= ' HRS ';
                            }
                        }

                        if ($cook_time['minutes']) {
                            $cook_time_string .= $cook_time['minutes'];
                            $cook_time_string .= ' MINS';
                        }

                        echo $cook_time_string;
                    ?>
                </span>
            </span>
        </div>

        <div class="difficulty">
            <img class="nopin" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon-skill.svg" alt="">
            <span><?php echo strtoupper($difficulty) ?></span>
        </div>

    </div>

    <div class="sidebar">

        <div class="inner">
            <div class="mobile-label">
                <img class="toggle-button nopin" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon-open.svg" alt="Open sidebar">
                <span>INGREDIENTS</span>
            </div>

            <div class="ingredients">
                <h2 class="title">Ingredients</h2>
                <?php echo $ingredients ?>
            </div>

        </div>


    </div>

    <div class="method">
        <?php echo $method ?>
    </div>
</div>