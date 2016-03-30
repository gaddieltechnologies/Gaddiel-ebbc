<?php
/*------------------------------------------------------------------------
# mod_featcats - Featured Categories
# ------------------------------------------------------------------------
# author    Joomla!Vargas
# copyright Copyright (C) 2010 joomla.vargas.co.cr. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomla.vargas.co.cr
# Technical Support:  Forum - http://joomla.vargas.co.cr/forum
-------------------------------------------------------------------------*/

defined('_JEXEC') or die; 
?>
        	<ul class="fc_links">
			<?php if ( $cat->subarticles) : foreach ($cat->subarticles as $subarticle) : 
				if ($params->get('ajaxed')) :
					$subarticle->link = str_replace('modules/mod_featcats/assets/','', $subarticle->link);
				endif; 			?>
        		<li>
				<?php if ($params->get('link_titles') == 1) : ?>
                <a class="fc_title <?php echo $subarticle->active; ?>" href="<?php echo $subarticle->link; ?>"<?php echo ($params->get('link_target') == 1 ? ' target="_blank"' : ''); ?>>
                <?php echo $subarticle->title; ?>
                <?php if ($subarticle->displayHits) :?>
                    <span class="fc_hits">
                    (<?php echo $subarticle->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php else :?>
                <?php echo $subarticle->title; ?>
                    <?php if ($subarticle->displayHits) :?>
                    <span class="fc_hits">
                    (<?php echo $subarticle->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php endif; ?>
				<?php if ($subarticle->displayAuthorName) :?>
					<span class="fc_writtenby">
					<?php echo $subarticle->displayAuthorName; ?>
					</span>
				<?php endif;?>
				<?php if ($subarticle->displayDate) : ?>
					<span class="fc_date<?php echo ($subarticle->displayAuthorName?' date-and-author':''); ?>"><?php echo $subarticle->displayDate; ?></span>
				<?php endif; ?>
                </li>
            <?php endforeach; endif; ?>
            <?php if ( $show_more==1 ) : ?>
            	<li class="fc_more"><a href="<?php echo $cat->category_link; ?>"><?php echo JText::_('MOD_FEATCATS_MORE_ARTICLES'); ?></a></li>
            <?php endif; ?>
            </ul>
