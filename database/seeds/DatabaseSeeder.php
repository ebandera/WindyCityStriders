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
		DB::table('user_profiles')->delete();
		DB::table('board_members')->delete();


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

		//seed our user_profiles table
		$adminProfile = UserProfile::create(array(
			'profile_name'=>'admin'
		));
		$userProfile = UserProfile::create(array(
			'profile_name'=>'user'
		));

		//seed our users table
		$userEric = User::create(array(
			'image_url'=>'http://www.ericbandera.com/images/me.jpg',
			'first_name'=>'Eric',
			'last_name'=>'Bandera',
			'user_profile_id'=>$adminProfile->id,
			'email'=>'ericbandera@gmail.com',
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
		$evergreenParkEvent = Event::create(array(
			'event_date'=>'2014-05-01',
			'event_name'=>'Run and Run 4',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));

		$evergreenParkEvent2 = Event::create(array(
			'event_date'=>'2014-04-10',
			'event_name'=>'Run and Run5',
			'event_img_url'=>'/img/calendarImage.jpg',
			'event_place_text'=>'Evergreen Park',
			'event_address'=>'5713 Moody, Chicago, Il 60638',
			'event_details'=>'Meet in playground, starts at noon',
			'event_info_path'=>'http://www.ericbandera.com',
			'event_results_path'=>'http://demo.shopced.com'

		));

		$evergreenParkEvent3 = Event::create(array(
			'event_date'=>'2016-05-20',
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
			'sort_order'=>1
		));
		//seed our gallery_items table

		$galleryItem1=GalleryItem::create(array(
			'image_url'=>'http://www.ericbandera.com/images/me.jpg',
			'caption'=>'My first Caption Gallery',
			'sort_order'=>1,
			'gallery_id'=>$evergreenParkGallery->id
		));

		//seed our blog file
		$ericBlog = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$blogPage->id,
			'event_id'=>$evergreenParkEvent->id,
			'blog_level'=>'primary',

			'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
			'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
			'image_url'=>'img/running_blog.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


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
			'image_url'=>'img/running_shoes.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


		));

		$ericBlogFour = Blog::create(array(
			'user_id'=>$userEric->id,
			'page_id'=>$blogPage->id,
			'event_id'=>$evergreenParkEvent->id,
			'blog_level'=>'primary',

			'heading'=>'This is a blog post!.(Clicking link will take you to article full page)',
			'html_text'=>'This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff. This is some blog post content! Lots of great content about running and stuff.',
			'image_url'=>'img/runBlog.jpg',
			'image_position'=>'top',
			'expiration_date'=>'2015-12-09',
			'sort_order'=>1


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
		//seed out board members table
		$marlene = BoardMember::create(array(
			'name'=>'Marlene Short',
			'year'=>'2015',
			'position'=>'President',
			'image_url'=>'img/Marlene.jpg',
			'description'=>'Just a little brief non-description of Marlene',
			'twitter_link'=>'',
			'facebook_link'=>'',
			'sort_order'=>1
		));

		$adam = BoardMember::create(array(
			'name'=>'Adam Linhart',
			'year'=>'2015',
			'position'=>'Vice President',
			'image_url'=>'img/Adam_Arguello.jpg',
			'description'=>'Just a little brief non-description of Adam',
			'twitter_link'=>'',
			'facebook_link'=>'',
			'sort_order'=>2
		));

		$allison = BoardMember::create(array(
			'name'=>'Allison Linhart',
			'year'=>'2015',
			'position'=>'Treasurer',
			'image_url'=>'img/Allison_Linhart.jpg',
			'description'=>'Just a little brief non-description of Allison',
			'twitter_link'=>'',
			'facebook_link'=>'',
			'sort_order'=>3
		));

		$joann = BoardMember::create(array(
			'name'=>'Joann True',
			'year'=>'2015',
			'position'=>'Secretary',
			'image_url'=>'img/Joann_True.jpg',
			'description'=>'Just a little brief non-description of Joann',
			'twitter_link'=>'',
			'facebook_link'=>'',
			'sort_order'=>4
		));

		$cindy = BoardMember::create(array(
			'name'=>'Cindy Rogers',
			'year'=>'2015',
			'position'=>'Board Member',
			'image_url'=>'img/Cindy.jpg',
			'description'=>'Just a little brief non-description of Cindy',
			'twitter_link'=>'',
			'facebook_link'=>'',
			'sort_order'=>5
		));


		//seed our result_items table






	}

}
