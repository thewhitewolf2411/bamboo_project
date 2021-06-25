<?php

use App\Eloquent\Blog;
use Illuminate\Database\Seeder;

class NewsBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = 1;
        while($n <= 4){
            Blog::create([
                'cms_type' => 0,
                'cms_title' => "This is an example of a featured article heading. More space if needed.",
                'image_1' => 'news_stock_image_'.$n.'.png',
                'cms_parg_1' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Curabitur accumsan tortor eget mauris euismod aliquam. 
                Praesent rhoncus, tellus nec molestie venenatis, tortor mi placerat orci, euismod tincidunt quam purus nec sapien. 
                Fusce sit amet ligula velit. Proin blandit mauris venenatis, finibus sapien vitae, ultricies leo. Nullam at ultrices massa. 
                Vivamus laoreet a nulla blandit bibendum. In pulvinar mauris ante, nec egestas arcu faucibus eu. ",
                'cms_parg_2' =>  "Nullam eu sapien dictum, eleifend nibh in, sollicitudin neque. Fusce dui elit, consequat eget enim a, 
                facilisis tincidunt diam. Ut accumsan justo orci, at placerat magna aliquam non. Nulla sed sapien ipsum. 
                Nulla consectetur convallis nibh in posuere. Suspendisse in mauris leo. Orci varius natoque penatibus et 
                magnis dis parturient montes, nascetur ridiculus mus. ",
                'cms_parg_3' => "Praesent efficitur massa massa, ut fringilla dui varius ac. Duis ac condimentum eros. 
                Curabitur tempus felis ut tincidunt fermentum. Curabitur enim urna, tempor sed magna ac, placerat dapibus enim. 
                Aenean varius, ex eu porta lacinia, nisi tortor rutrum felis, id vestibulum risus nisi et mi. 
                Aliquam ac tellus pellentesque, pretium est id, semper orci. Aenean venenatis tellus vehicula diam finibus eleifend. 
                Cras lectus elit, tristique sit amet porta in, tempor sit amet neque. Nam bibendum urna sit amet justo varius, 
                ac blandit augue scelerisque. Aliquam ante libero, porttitor sit amet fermentum non, 
                elementum eu sem. ",
                'cms_parg_3' => "Sed quis magna eu mauris fermentum tempus vulputate vel felis.
                 Aenean condimentum eros ut nunc auctor tristique. Maecenas ut tellus nisi. 
                 Donec sed urna urna. Proin euismod malesuada interdum. 
                 Cras ut massa vel massa vestibulum auctor. Morbi eu iaculis enim, 
                 non sagittis lorem. Vestibulum eleifend lacinia orci eu consectetur. 
                 Suspendisse semper, risus vitae ultricies tristique, nisi felis accumsan ex, 
                 vel molestie ex libero id odio. Nam hendrerit ornare malesuada. Cras id elit 
                 vitae lacus facilisis fringilla nec ac sapien. Nulla a turpis at mauris finibus
                  dignissim. Nulla ut nisi porta, tristique dui id, pretium neque. Duis pharetra
                   ipsum in erat aliquam luctus. Phasellus cursus lacus eu risus blandit cursus.
                    Proin sed turpis elit.",
                'author' => "bamboo admin"
            ]);
            $n++;
        }

        $b = 1;
        while($b <= 4){
            Blog::create([
                'cms_type' => 1,
                'cms_title' => "This is an example of a featured article heading. More space if needed.",
                'image_1' => 'news_stock_image_'.$b.'.png',
                'cms_parg_1' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Curabitur accumsan tortor eget mauris euismod aliquam. 
                Praesent rhoncus, tellus nec molestie venenatis, tortor mi placerat orci, euismod tincidunt quam purus nec sapien. 
                Fusce sit amet ligula velit. Proin blandit mauris venenatis, finibus sapien vitae, ultricies leo. Nullam at ultrices massa. 
                Vivamus laoreet a nulla blandit bibendum. In pulvinar mauris ante, nec egestas arcu faucibus eu. ",
                'cms_parg_2' =>  "Nullam eu sapien dictum, eleifend nibh in, sollicitudin neque. Fusce dui elit, consequat eget enim a, 
                facilisis tincidunt diam. Ut accumsan justo orci, at placerat magna aliquam non. Nulla sed sapien ipsum. 
                Nulla consectetur convallis nibh in posuere. Suspendisse in mauris leo. Orci varius natoque penatibus et 
                magnis dis parturient montes, nascetur ridiculus mus. ",
                'cms_parg_3' => "Praesent efficitur massa massa, ut fringilla dui varius ac. Duis ac condimentum eros. 
                Curabitur tempus felis ut tincidunt fermentum. Curabitur enim urna, tempor sed magna ac, placerat dapibus enim. 
                Aenean varius, ex eu porta lacinia, nisi tortor rutrum felis, id vestibulum risus nisi et mi. 
                Aliquam ac tellus pellentesque, pretium est id, semper orci. Aenean venenatis tellus vehicula diam finibus eleifend. 
                Cras lectus elit, tristique sit amet porta in, tempor sit amet neque. Nam bibendum urna sit amet justo varius, 
                ac blandit augue scelerisque. Aliquam ante libero, porttitor sit amet fermentum non, 
                elementum eu sem. ",
                'cms_parg_3' => "Sed quis magna eu mauris fermentum tempus vulputate vel felis.
                 Aenean condimentum eros ut nunc auctor tristique. Maecenas ut tellus nisi. 
                 Donec sed urna urna. Proin euismod malesuada interdum. 
                 Cras ut massa vel massa vestibulum auctor. Morbi eu iaculis enim, 
                 non sagittis lorem. Vestibulum eleifend lacinia orci eu consectetur. 
                 Suspendisse semper, risus vitae ultricies tristique, nisi felis accumsan ex, 
                 vel molestie ex libero id odio. Nam hendrerit ornare malesuada. Cras id elit 
                 vitae lacus facilisis fringilla nec ac sapien. Nulla a turpis at mauris finibus
                  dignissim. Nulla ut nisi porta, tristique dui id, pretium neque. Duis pharetra
                   ipsum in erat aliquam luctus. Phasellus cursus lacus eu risus blandit cursus.
                    Proin sed turpis elit.",
                'author' => "bamboo admin"
            ]);
            $b++;
        }

        $h = 1;
        while($h <= 4){
            Blog::create([
                'cms_type' => 2,
                'cms_title' => "This is an example of a featured article heading. More space if needed.",
                'image_1' => 'news_stock_image_'.$h.'.png',
                'cms_parg_1' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Curabitur accumsan tortor eget mauris euismod aliquam. 
                Praesent rhoncus, tellus nec molestie venenatis, tortor mi placerat orci, euismod tincidunt quam purus nec sapien. 
                Fusce sit amet ligula velit. Proin blandit mauris venenatis, finibus sapien vitae, ultricies leo. Nullam at ultrices massa. 
                Vivamus laoreet a nulla blandit bibendum. In pulvinar mauris ante, nec egestas arcu faucibus eu. ",
                'cms_parg_2' =>  "Nullam eu sapien dictum, eleifend nibh in, sollicitudin neque. Fusce dui elit, consequat eget enim a, 
                facilisis tincidunt diam. Ut accumsan justo orci, at placerat magna aliquam non. Nulla sed sapien ipsum. 
                Nulla consectetur convallis nibh in posuere. Suspendisse in mauris leo. Orci varius natoque penatibus et 
                magnis dis parturient montes, nascetur ridiculus mus. ",
                'cms_parg_3' => "Praesent efficitur massa massa, ut fringilla dui varius ac. Duis ac condimentum eros. 
                Curabitur tempus felis ut tincidunt fermentum. Curabitur enim urna, tempor sed magna ac, placerat dapibus enim. 
                Aenean varius, ex eu porta lacinia, nisi tortor rutrum felis, id vestibulum risus nisi et mi. 
                Aliquam ac tellus pellentesque, pretium est id, semper orci. Aenean venenatis tellus vehicula diam finibus eleifend. 
                Cras lectus elit, tristique sit amet porta in, tempor sit amet neque. Nam bibendum urna sit amet justo varius, 
                ac blandit augue scelerisque. Aliquam ante libero, porttitor sit amet fermentum non, 
                elementum eu sem. ",
                'cms_parg_3' => "Sed quis magna eu mauris fermentum tempus vulputate vel felis.
                 Aenean condimentum eros ut nunc auctor tristique. Maecenas ut tellus nisi. 
                 Donec sed urna urna. Proin euismod malesuada interdum. 
                 Cras ut massa vel massa vestibulum auctor. Morbi eu iaculis enim, 
                 non sagittis lorem. Vestibulum eleifend lacinia orci eu consectetur. 
                 Suspendisse semper, risus vitae ultricies tristique, nisi felis accumsan ex, 
                 vel molestie ex libero id odio. Nam hendrerit ornare malesuada. Cras id elit 
                 vitae lacus facilisis fringilla nec ac sapien. Nulla a turpis at mauris finibus
                  dignissim. Nulla ut nisi porta, tristique dui id, pretium neque. Duis pharetra
                   ipsum in erat aliquam luctus. Phasellus cursus lacus eu risus blandit cursus.
                    Proin sed turpis elit.",
                'author' => "bamboo admin"
            ]);
            $h++;
        }
    }
}
