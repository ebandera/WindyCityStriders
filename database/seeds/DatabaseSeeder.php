<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Page;
use App\UserProfile;
use App\User;
use App\Event;
use App\Gallery;
use App\GalleryItem;
use App\Blog;
use App\BoardMember;
use App\ResultItem;
use App\CarouselItem;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Eloquent::unguard();

		// call our class and run our seeds
		$this->call('TestDataSeeder');
		$this->command->info('Test Data seeds finished.'); // show information in the command line after everything is run
	}

}
class TestDataSeeder extends Seeder {

	public function run()
	{
		//make sure all the data is cleared
		DB::table('result_items')->delete();
		DB::table('gallery_items')->delete();
		DB::table('galleries')->delete();
		DB::table('blogs')->delete();
		DB::table('pages')->delete();
		DB::table('events')->delete();
		DB::table('password_resets')->delete();
		DB::table('users')->delete();

		DB::table('board_members')->delete();
        DB::table('carousel_items')->delete();


		//seed our pages table

		$blogPage = Page::create(array(
			'title'=>'Blog'
		));

		$galleryPage = Page::create(array(
			'title'=>'Gallery'
		));
		$aboutPage = Page::create(array(
			'title'=>'About'
		));

        $contactPage = Page::create(array(
            'title'=>'Contact'
        ));
        $homePage = Page::create(array(
            'title'=>'Home'
        ));

		//seed our user_profiles table
		//$adminProfile = UserProfile::create(array(
		//	'profile_name'=>'admin'
		//));
		//$userProfile = UserProfile::create(array(
		//	'profile_name'=>'member'
		//));

		//seed our users table
		$userEric = User::create(array(
			'image_url'=>'http://www.ericbandera.com/images/me.jpg',
			'name'=>'Eric Bandera',
			'user_profile'=>'admin',
			'email'=>'ericbandera@gmail.com',
			'password'=>'1234'

		));
        $userBob = User::create(array(
            'image_url'=>'http://www.ericbandera.com/images/me.jpg',
            'name'=>'Bob Bandera',
            'user_profile'=>'member',
            'email'=>'bad@gmail.com',
            'password'=>'1234'

        ));

		//seed our events table
		$evergreenParkEvent = Event::create(array(
		'event_date'=>'2014-04-01',
		'event_name'=>'Run and Run 1',
		'event_img_url'=>'/img/calendarImage.jpg',
		'event_place_text'=>'Evergreen Park',
		'event_address'=>'5713 Moody, Chicago, Il 60638',
		'event_details'=>'Meet in playground, starts at noon',
		'event_info_path'=>'http://www.ericbandera.com',
		'event_results_path'=>'http://demo.shopced.com'

	));

		$evergreenParkEvent2 = Event::create(array(
			'event_date'=>'2015-04-10',
			'event_name'=>'Run and Run2',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));

		$evergreenParkEvent3 = Event::create(array(
			'event_date'=>'2015-05-20',
			'event_name'=>'Run and Run3',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));
		$evergreenParkEvent4 = Event::create(array(
			'event_date'=>'2014-05-01',
			'event_name'=>'Run and Run 4',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));

		$evergreenParkEvent5 = Event::create(array(
			'event_date'=>'2014-04-11',
			'event_name'=>'Run and Run5',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));

		$evergreenParkEvent6 = Event::create(array(
			'event_date'=>'2016-05-20',
			'event_name'=>'Run and Run6',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));
        $evergreenParkEvent7 = Event::create(array(
            'event_date'=>'2015-05-21',
            'event_name'=>'Run and Run 1',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent8 = Event::create(array(
            'event_date'=>'2015-04-18',
            'event_name'=>'Run and Run2',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent9 = Event::create(array(
            'event_date'=>'2015-06-13',
            'event_name'=>'Run and Run3',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));
        $evergreenParkEvent10 = Event::create(array(
            'event_date'=>'2015-06-02',
            'event_name'=>'Run and Run 4',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent11 = Event::create(array(
            'event_date'=>'2015-07-15',
            'event_name'=>'Run and Run5',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent12 = Event::create(array(
            'event_date'=>'2015-07-23',
            'event_name'=>'Run and Run6',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));
        $evergreenParkEvent13 = Event::create(array(
            'event_date'=>'2015-04-29',
            'event_name'=>'Run and Run 1',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent14 = Event::create(array(
            'event_date'=>'2015-04-17',
            'event_name'=>'Run and Run2',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent15 = Event::create(array(
            'event_date'=>'2015-08-14',
            'event_name'=>'Run and Run3',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));
        $evergreenParkEvent16 = Event::create(array(
            'event_date'=>'2015-03-26',
            'event_name'=>'Run and Run 4',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent17 = Event::create(array(
            'event_date'=>'2014-07-09',
            'event_name'=>'Run and Run5',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));

        $evergreenParkEvent18 = Event::create(array(
            'event_date'=>'2015-09-20',
            'event_name'=>'Run and Run6',
            'event_img_url'=>'/img/calendarImage.jpg',
            'event_place_text'=>'Evergreen Park',
            'event_address'=>'5713 Moody, Chicago, Il 60638',
            'event_details'=>'Meet in playground, starts at noon',
            'event_info_path'=>'http://www.ericbandera.com',
            'event_results_path'=>'http://demo.shopced.com'

        ));
		//seed our galleries table

		$evergreenParkGallery = Gallery::create(array(
			'event_id'=>$evergreenParkEvent->id,
            'title'=>'Gallery For Event 1',
            'image_url'=>'/img/galleryTEMPimage2.jpg',
			'sort_order'=>1
		));
        $evergreenParkGallery2 = Gallery::create(array(
            'event_id'=>$evergreenParkEvent2->id,
            'title'=>'Gallery For Event 2',
            'image_url'=>'/img/galleryTEMPimage.jpg',
            'sort_order'=>1
        ));
        $evergreenParkGallery3 = Gallery::create(array(
            'event_id'=>$evergreenParkEvent3->id,
            'title'=>'Gallery For Event 3',
            'image_url'=>'/img/galleryTEMPimage2.jpg',
            'sort_order'=>1
        ));
        $evergreenParkGallery4 = Gallery::create(array(
            'event_id'=>$evergreenParkEvent4->id,
            'title'=>'Gallery For Event 4',
            'image_url'=>'/img/galleryTEMPimage.jpg',
            'sort_order'=>1
        ));
		//seed our gallery_items table

		$galleryItem1=GalleryItem::create(array(
			'image_url'=>'/img/slideshow.png',
			'caption'=>'My first Caption Gallery',
			'sort_order'=>1,
			'gallery_id'=>$evergreenParkGallery->id
		));
        $galleryItem2=GalleryItem::create(array(
            'image_url'=>'/img/gallery1.jpeg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>2,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem3=GalleryItem::create(array(
            'image_url'=>'/img/gallery2.jpeg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>3,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem4=GalleryItem::create(array(
            'image_url'=>'/img/gallery3.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>4,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem5=GalleryItem::create(array(
            'image_url'=>'/img/gallery4.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>5,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem6=GalleryItem::create(array(
            'image_url'=>'/img/gallery5.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>6,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem7=GalleryItem::create(array(
            'image_url'=>'/img/gallery6.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>7,
            'gallery_id'=>$evergreenParkGallery->id
        ));
        $galleryItem8=GalleryItem::create(array(
            'image_url'=>'/img/gallery7.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>8,
            'gallery_id'=>$evergreenParkGallery->id
        ));

        $galleryItem9=GalleryItem::create(array(
            'image_url'=>'/img/slideshow.png',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>1,
            'gallery_id'=>$evergreenParkGallery2->id
        ));
        $galleryItem10=GalleryItem::create(array(
            'image_url'=>'/img/gallery1.jpeg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>2,
            'gallery_id'=>$evergreenParkGallery2->id
        ));
        $galleryItem11=GalleryItem::create(array(
            'image_url'=>'/img/gallery2.jpeg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>3,
            'gallery_id'=>$evergreenParkGallery2->id
        ));
        $galleryItem12=GalleryItem::create(array(
            'image_url'=>'/img/gallery3.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>4,
            'gallery_id'=>$evergreenParkGallery2->id
        ));
        $galleryItem13=GalleryItem::create(array(
            'image_url'=>'/img/gallery4.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>5,
            'gallery_id'=>$evergreenParkGallery3->id
        ));
        $galleryItem14=GalleryItem::create(array(
            'image_url'=>'/img/gallery5.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>6,
            'gallery_id'=>$evergreenParkGallery3->id
        ));
        $galleryItem15=GalleryItem::create(array(
            'image_url'=>'/img/gallery6.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>7,
            'gallery_id'=>$evergreenParkGallery3->id
        ));
        $galleryItem16=GalleryItem::create(array(
            'image_url'=>'/img/gallery7.jpg',
            'caption'=>'My first Caption Gallery',
            'sort_order'=>8,
            'gallery_id'=>$evergreenParkGallery4->id
        ));

		//seed our blog file
		$ericBlog = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$blogPage->id,
			'event_id'=>$evergreenParkEvent->id,
			'blog_level'=>'primary',

			'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
			'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
			'image_url'=>'/img/running_blog.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>0


		));

		$ericBlogTwo = Blog::create(array(
		'user_id'=>$userEric->id,
		'page_id'=>$blogPage->id,
		'event_id'=>$evergreenParkEvent->id,
		'blog_level'=>'primary',

		'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
		'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
		'image_url'=>'',
		'image_position'=>'top',
		'expiration_date'=>'2015-12-09',
		'sort_order'=>1


	));
		$ericBlogThree = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$blogPage->id,
			'event_id'=>$evergreenParkEvent->id,
			'blog_level'=>'primary',

			'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
			'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
			'image_url'=>'/img/running_shoes.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>2


		));

		$ericBlogFour = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$blogPage->id,
			'event_id'=>$evergreenParkEvent->id,
			'blog_level'=>'primary',

			'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
			'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
			'image_url'=>'/img/runBlog.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>3


		));

        $ericBlogFive = Blog::create(array(
            'user_id'=>$userEric->id,
            'page_id'=>$blogPage->id,
            'event_id'=>$evergreenParkEvent->id,
            'blog_level'=>'reply',
            'blog_id'=>$ericBlog->id,
            'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
            'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
            'image_url'=>'/img/runBlog.jpg',
            'image_position'=>'top',
            'expiration_date'=>'2015-12-09',
            'sort_order'=>4


        ));
		$ericAboutOne = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$aboutPage->id,

			'blog_level'=>'primary',

			'heading'=>'Our Purpose',
			'html_text'=>'The purpose of the Casper Windy City Striders is to promote and encourage running related activities for runners of all ages and abilities.The Casper Windy City Striders is an entirely volunteer organization and your help with any of the club\'s activities will be appreciated. Please feel free to contact any board member if you would like to volunteer, suggest new ideas, or have any comments (good or bad) regarding any of the Strider events.',
			'image_url'=>'',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


		));

		$ericAboutTwo = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$aboutPage->id,

			'blog_level'=>'primary',

			'heading'=>'Your Membership',
			'html_text'=>'in the Striders provides discounted race fees, enrollment in the Road Runners Club of America (including RRCA insurance), a year\'s subscription to The Colorado Runner magazine, and a long sleeve WCS tech shirt. With your membership card you will get 15% off running shoes and running apparel at Bush-Wells Sporting Goods, 15% off merchandise at Gear Up and Mountain Sports will provide race awards.',
			'image_url'=>'',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


		));

		$ericAboutThree = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$aboutPage->id,

			'blog_level'=>'primary',

			'heading'=>'Email List',
			'html_text'=>'Emails are sent before upcoming races with detailed information regarding registration, course, fees, etc. Other club info/news is also emailed to the group throughout the year. Anyone who is interested in the club can join our group email list, simply send an email to Marlene Short to be added to the list.',
			'image_url'=>'',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


		));
        $ericAboutNewsletter = Blog::create(array(
            'user_id'=>$userEric->id,
            'page_id'=>$aboutPage->id,

            'blog_level'=>'',

            'heading'=>'newsletter',
            'html_text'=>'Emails are sent before upcoming races with detailed information regarding registration, course, fees, etc. Other club info/news is also emailed to the group throughout the year. Anyone who is interested in the club can join our group email list, simply send an email to Marlene Short to be added to the list.',
            'image_url'=>'/img/usercontent/newsletter.jpg',
            'image_position'=>'top',
            'expiration_date'=>'2015-12-09',
            'sort_order'=>1


        ));
        $contactInformation = Blog::create(array(
            'user_id'=>$userEric->id,
            'page_id'=>$contactPage->id,

            'blog_level'=>'primary',

            'heading'=>'',
            'image_url'=>'',
            'html_text'=>'Address: P.O. Box 52161 Casper, WY',
            'image_position'=>'',
            'expiration_date'=>'2015-12-09',
            'sort_order'=>1

        ));
		//seed out board members table
		$marlene = BoardMember::create(array(
			'name'=>'Marlene Short',
			'year'=>'2015',
			'position'=>'PRESIDENT',
			'image_url'=>'/img/Marlene.jpg',
            'twitter_link'=>'http://mytwitterurlforMarlene.com',
            'facebook_link'=>'http://myfacebookurlforMarlene.com',
			'description'=>'Just a little brief non-description of Marlene',
		    'sort_order'=>1
		));

		$adam = BoardMember::create(array(
			'name'=>'Adam Linhart',
			'year'=>'2015',
			'position'=>'VICE PRESIDENT',
			'image_url'=>'/img/Adam_Arguello.jpg',
            'twitter_link'=>'http://mytwitterurlforAdam.com',
            'facebook_link'=>'http://myfacebookurlforAdam.com',
			'description'=>'Just a little brief non-description of Adam',
			'sort_order'=>2
		));

		$allison = BoardMember::create(array(
			'name'=>'Allison Linhart',
			'year'=>'2015',
			'position'=>'TREASURER',
			'image_url'=>'/img/Allison_Linhart.jpg',
            'twitter_link'=>'http://mytwitterurlforAllison.com',
            'facebook_link'=>'http://myfacebookurlforAllison.com',
			'description'=>'Just a little brief non-description of Allison',
			'sort_order'=>3
		));

		$joann = BoardMember::create(array(
			'name'=>'Joann True',
			'year'=>'2015',
			'position'=>'SECRETARY',
			'image_url'=>'/img/Joann_True.jpg',
            'twitter_link'=>'http://mytwitterurlforJoann.com',
            'facebook_link'=>'http://myfacebookurlforJoann.com',
			'description'=>'Just a little brief non-description of Joann',
			'sort_order'=>4
		));

		$cindy = BoardMember::create(array(
			'name'=>'Cindy Rogers',
			'year'=>'2015',
			'position'=>'BOARD MEMBER',
			'image_url'=>'/img/Cindy.jpg',
            'twitter_link'=>'http://mytwitterurlforCindy.com',
            'facebook_link'=>'http://myfacebookurlforCindy.com',
			'description'=>'Just a little brief non-description of Cindy',
			'sort_order'=>5
		));

        $carouselItem1 = CarouselItem::create(array(
            'reference_name'=>'My First Item',
            'image_url'=>'/img/slideshow.png',
            'caption'=>'My First Caption',
            'sort_order'=>1

        ));
        $carouselItem2 = CarouselItem::create(array(
        'reference_name'=>'My Second Item',
        'image_url'=>'/img/runningSlideShow.jpg',
        'caption'=>'My Second Caption',
        'sort_order'=>2

        ));
        $carouselItem3 = CarouselItem::create(array(
        'reference_name'=>'My Third Item',
        'image_url'=>'/img/runningSlideShow2.jpg',
        'caption'=>'My Third Caption',
        'sort_order'=>3

        ));
		//seed our result_items table






	}

}
