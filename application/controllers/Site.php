<?php
class Site extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('dbclass');
		$this->load->helper('common_functions');
		$this->load->helper('text');
	}
	
	
   
	function index()
	{
// 		$data['news']=$this->db->get('flashnews')->result_array();
		$query0=$this->db->query("SELECT * FROM flashnews where Status='Active' ORDER BY Id DESC");
		$data['news']=$query0->result_array();
		//$data['song']=$this->db->get('song_tb',3)->result_array();
		$query2=$this->db->query("SELECT * FROM song_tb where Status='Active' ORDER BY Id DESC  LIMIT 3");
		$data['song']=$query2->result_array();
		$query11=$this->db->query("SELECT trailer_tb.* FROM  trailer_tb JOIN film_tb ON film_tb.Id=FilmId where trailer_tb.Status='Active' ORDER BY film_tb.DateCreated DESC,Id DESC LIMIT 3");
		$data['trailer']=$query11->result_array();
		
		$data['trailers']=$this->db->get_where('trailer_tb'," Status='Active' ORDER BY Id DESC LIMIT 10")->result_array();
		
		$query1=$this->db->query("SELECT * FROM song_tb where Status='Active' ORDER BY Id DESC LIMIT 10");
		$data['songs']=$query1->result_array();
		
		$query3=$this->db->query("SELECT * FROM film_tb where Category='Release' AND Status='Active' ORDER BY DateCreated DESC,Id DESC LIMIT 3");
		$data['film']=$query3->result_array();
		$query9=$this->db->query("SELECT * FROM film_tb where Category='Release' AND Status='Active'  ORDER BY DateCreated DESC,Id DESC LIMIT 3");
		$data['films']=$query9->result_array();
		
		$query4=$this->db->query("SELECT * FROM film_tb where Category='Upcoming' AND Status='Active' ORDER BY DateCreated DESC,Id DESC LIMIT 3");
		$data['upcoming']=$query4->result_array();
		
	    //$data['film']=$this->db->get_where('film_tb',"Category = 'Release'",3)->result_array();
		//$this->db->limit(10);  
		//$data['upcoming']=$this->db->get_where('film_tb',"Category = 'Upcoming'",3)->result_array();
		
		$query5=$this->db->query("SELECT * FROM boxoffice where Status='Active' ORDER BY Id DESC LIMIT 4");
		$data['boxoffice']=$query5->result_array();
		//$data['boxoffice']=$this->db->get('boxoffice',5)->result_array();
		//$data['interviews']=$this->db->get('interview_tb',4)->result_array();
		//data['interview']=$this->db->get('reviews',4)->result_array();
		
		$querys=$this->db->query("SELECT * FROM interview_tb where Status='Active' ORDER BY Id DESC  LIMIT 4");
		$data['interview']=$querys->result_array();
		
		$query=$this->db->query("SELECT * FROM reviews where Status='Active' ORDER BY Id DESC  LIMIT 4");
		$data['review']=$query->result_array();
		
		$data['sl']=$this->db->get_where('slide_tb',"Status = 'Active' ORDER BY Id DESC")->result_array();
		
		$query10=$this->db->query("SELECT * FROM advertise where Status='Active' ORDER BY Id DESC  LIMIT 2");
		$data['add']=$query10->result_array();
		
		$query11=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='Homepage_up' ORDER BY Id DESC  LIMIT 1");
		$data['add_up']=$query11->result_array();
		$query12=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='Homepage_down' ORDER BY Id DESC  LIMIT 1");
		$data['add_down']=$query12->result_array();
		
		$this->load->view('public/Cinema/index',$data);
		
		 
	}
	function latestrelease()
	{
	    $data['film']=$this->db->get_where('film_tb',"Category = 'Release' AND Status='Active' ORDER BY Id DESC")->result_array();
		$data['lan']=$this->db->get_where('language',"Status = 'Active'")->result_array();
		//$data['trailer']=$this->db->get_where('trailer_tb',"Status='Active' ORDER BY Id DESC LIMIT 1")->row_array();

		$query0=$this->db->query("SELECT * FROM trailer_tb where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['trailer']=$query0->result_array();
		$query1=$this->db->query("SELECT * FROM song_tb where Status='Active' ORDER BY Id DESC LIMIT 5 ");
		$data['songs']=$query1->result_array();
		$query10=$this->db->query("SELECT * FROM advertise where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['add']=$query10->result_array();
		$query11=$this->db->query("SELECT * FROM cast_tb where Status='Active' ORDER BY Id DESC");
		$data['photo']=$query11->result_array();
		//$data['lang']=$this->db->get_where('film_tb',"Language = 'Malayalam'")->result_array();
		//$data['upcoming']=$this->db->get_where('film_tb',"Category = 'Upcoming'")->result_array();
		$this->load->view('public/Cinema/latest-release',$data);
	}
	
	function latest()
	{
	    $data['film']=$this->db->get_where('film_tb',"Category = 'Release' AND Status='Active' ORDER BY DateCreated DESC,Id DESC")->result_array();
		$data['lan']=$this->db->get_where('language',"Status = 'Active'")->result_array();
		$data['lang']=$this->db->get_where('film_tb',"Language = 'Malayalam' AND Status = 'Active'")->result_array();
		$query12=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='NewsList' ORDER BY Id DESC  LIMIT 0,2");
		$data['add_news_list']=$query12->result_array();
		//$data['upcoming']=$this->db->get_where('film_tb',"Category = 'Upcoming'")->result_array();
		$this->load->view('public/Cinema/more_news',$data);
	}
	function upcomings()
	{
	    $data['film']=$this->db->get_where('film_tb',"Category = 'Upcoming' AND Status='Active' ORDER BY DateCreated DESC,Id DESC")->result_array();
		$data['lan']=$this->db->get_where('language',"Status = 'Active'")->result_array();
		$data['lang']=$this->db->get_where('film_tb',"Language = 'Malayalam' AND Status = 'Active'")->result_array();
    	$query12=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='NewsList' ORDER BY Id DESC  LIMIT 0,2");
		$data['add_news_list']=$query12->result_array();
		//$data['upcoming']=$this->db->get_where('film_tb',"Category = 'Upcoming'")->result_array();
		$this->load->view('public/Cinema/more_news',$data);
	}
	
	
	function upcoming()
	{
	    $data['film']=$this->db->get_where('film_tb',"Category = 'Upcoming' AND Status = 'Active' ORDER BY Id DESC")->result_array();
		$data['lan']=$this->db->get_where('language',"Status = 'Active'")->result_array();
		//$data['lang']=$this->db->get_where('film_tb',"Language = 'Malayalam'")->result_array();
		//$data['upcoming']=$this->db->get_where('film_tb',"Category = 'Upcoming'")->result_array();
		$query0=$this->db->query("SELECT * FROM trailer_tb where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['upcoming']=$query0->result_array();
		$query1=$this->db->query("SELECT * FROM song_tb where Status='Active' ORDER BY Id DESC LIMIT 5 ");
		$data['songs']=$query1->result_array();
		$query10=$this->db->query("SELECT * FROM advertise where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['add']=$query10->result_array();
		$query11=$this->db->query("SELECT * FROM cast_tb where Status='Active' ORDER BY Id DESC");
		$data['photo']=$query11->result_array();
		$this->load->view('public/Cinema/upcomings',$data);
	}
	function film($lan)
	{
		
	$data['lang']=$this->db->get_where('film_tb',"Language = '$lan'")->result_array();
		
		
	}
	
	
	
	
	function upcomingmovies()
	{
	
		$this->load->view('public/Cinema/latest-release');
	}
	function interviews()
	{
	    $data['interview']=$this->db->get_where('interview_tb',"Status = 'Active' ORDER BY Id DESC")->result_array();
		$this->load->view('public/Cinema/interviews',$data);
	}
	function interviewdetails($id)
	{
		$query6=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='Detail' ORDER BY Id DESC  LIMIT 0,2");
		$data['add']=$query6->result_array();
		
		//$data['add']=$this->db->get('advertise',1)->result_array();
	    $data['interview']=$this->db->get_where('interview_tb',"Id = '$id' AND Status = 'Active'")->row_array();
		$this->load->view('public/Cinema/interviews-detail',$data);
	}
	
	function roundup()
	{
	    $round=$this->db->query("SELECT * FROM roundup where Status='Active' ORDER BY Id DESC");
		$data['roundup']=$round->result_array();
		$this->load->view('public/Cinema/roundup',$data);
	}
	function shortfilm()
	{
	    $round=$this->db->query("SELECT * FROM shortfilm_tb where Status='Active' ORDER BY Id DESC");
		$data['shortfilm']=$round->result_array();
		$this->load->view('public/Cinema/roundup',$data);
	}
	function reviews()
	{ 
	
	    $data['review']=$this->db->get_where('reviews',"Status = 'Active' ORDER BY Id DESC")->result_array();
		$this->load->view('public/Cinema/reviews',$data);
	}
	function reviewdetail($id)
	{
		$query7=$this->db->query("SELECT * FROM advertise where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['add']=$query7->result_array();
		//$data['add']=$this->db->get('advertise',1)->result_array();
	    $data['review']=$this->db->get_where('reviews',"Id = '$id' AND Status = 'Active'")->row_array();
		$this->load->view('public/Cinema/reviews-detail',$data);
	}
	
	function loudspeaker()
	{
	
		$this->load->view('public/Cinema/reviews');
	}
	function trailer()
	{
	    //$data['trailer']=$this->db->get_where('trailer_tb',"Status = 'Active' ORDER BY Id DESC")->result_array();
	    
	    $query=$this->db->query("SELECT trailer_tb.* FROM  trailer_tb JOIN film_tb ON film_tb.Id=FilmId where trailer_tb.Status='Active' ORDER BY film_tb.DateCreated DESC,Id DESC");
		$data['trailer']=$query->result_array();
	    
		$this->load->view('public/Cinema/trailers',$data);
	}
	function songs()
	{
	   // $data['song']=$this->db->get_where('song_tb',"Status = 'Active' ORDER BY Id DESC")->result_array();
	    
	    $query=$this->db->query("SELECT song_tb.* FROM  song_tb JOIN film_tb ON film_tb.Id=FilmId where song_tb.Status='Active' ORDER BY DateCreated DESC");
		$data['song']=$query->result_array();
		$this->load->view('public/Cinema/song',$data);
	}
	
	function detail($id)
	{
		$data['films']=$this->db->get_where('film_tb',"UniqueName = '$id' AND Status = 'Active'")->result_array();
		$query11=$this->db->query("SELECT * FROM advertise where Status='Active' ORDER BY Id DESC  LIMIT 1");
		$data['side_add']=$query11->result_array();
		$numbers=$this->db->get_where('film_tb',"UniqueName = '$id'")->result();
		foreach($numbers as $ids){
		    $test=$ids->Id;
	 //    $data['details']=$this->db->get_where('storyline',"FilmId = '$id' AND Status = 'Active'")->row_array();
		// $data['cast']=$this->db->get_where('cast_tb',"FilmId = $ids->Id AND Status = 'Active'")->result_array();
		$data['songs']=$this->db->get_where('song_tb',"FilmId = $test AND Status = 'Active'")->result_array();
		$data['trailer']=$this->db->get_where('trailer_tb',"FilmId = $test AND Status = 'Active'")->result_array();
		$query8=$this->db->query("SELECT * FROM trailer_tb where FilmId=$test AND Status = 'Active' ORDER BY Id DESC LIMIT 1");
		$data['trailers']=$query8->result_array();
		$data['theater']=$this->db->get_where('theater_tb',"FilmId = $test AND Status = 'Active'")->result_array();
		$query12=$this->db->query("SELECT * FROM advertise where Status='Active' AND Space='Detail' ORDER BY Id DESC  LIMIT 0,2");
		$data['add_detail']=$query12->result_array();
		$data['photo']=$this->db->get_where('cast_tb',"FilmId = $test AND Status = 'Active'")->result_array();
		$data['boxoffice']=$this->db->get_where('boxoffice',"FilmId = $test AND Status = 'Active'")->result_array();
		}
// 		echo '<pre>',print_r($data),'</pre>';
		$this->load->view('public/Cinema/detail',$data);
		// $query5=$this->db->query("SELECT * FROM boxoffice where Status='Active' ORDER BY Id DESC LIMIT 4");
		// $data['boxoffice']=$query5->result_array();

		
	}
	// function more_news()
	// {
	//     $data['more_news']=$this->db->get_where('film_tb',"Category = 'Release' AND Status='Active' ")->result_array();
	// 	$this->load->view('public/Cinema/song',$data);
	// }
	
}
