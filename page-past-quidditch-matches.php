<?php 
get_header(); ?>


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
      
    
     <?php the_field('header_title'); ?>
     <!--
      ovo su if else statementi ako hoces da imas kontrolu sta da ti pise na kategoriji na autoru itd ali imas i jednu funkciju koja resava sve the_archive_title()
      if(is_category()){
          single_cat_title();
      }
      if(is_author()){
          echo 'News by '; the_author();
      }
      ---->
      </h1>
      <div class="page-banner__intro">
        <p><?php the_field('header_subtitle')?></p> <!-- description of category users itd--->
      </div>
    </div>  
  </div>

<div class="container container--narrow page-section">
<?php 

$today = date('Ymd'); //vraca danasnji datum year month date koristimo ga dole za 'value
          $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),   //ovo pomaze pri paginaciji custo querija
            'post_type' => 'quidditch', 
            'meta_key' => 'quidditch_date', /*from ACF kada hoces da sortiras po tome*/
            'orderby' => /*post_date -default, 'title'- abc..., 'rand' -random, meta_value -custom order preko ACF(letters and words), meta_value_num(brojevi)*/  'meta_value_num',
            'order'=> /*DESC je default, 'ASC' */ 'DESC',
            'meta_query' => array(  /*fjonalnost da ne prikazuje evetove koji su se odigrali*/
               array(
                 'key' => 'quidditch_date', /*nas custom field*/
                 'compare' => '<=',  //vece ili jednako
                 'value' => $today,
                 'type' => 'numeric'
               )
            )
            
          ));


while($pastEvents->have_posts()){
$pastEvents->the_post(); ?>

<div class="event-summary">
<a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
              <span class="event-summary__month"><?php $MonthDay = new DateTime(get_field('quidditch_date') ); 
              echo $MonthDay->format('M'); 
              ?></span>
              <span class="event-summary__day"><?php echo $MonthDay->format('d')
              ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
              <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>
<?php }

/*pagination*/
echo paginate_links(array(
  'total' => $pastEvents->max_num_pages
)); //works only with default wp queries
?>

</div>

<?php
get_footer();
?>