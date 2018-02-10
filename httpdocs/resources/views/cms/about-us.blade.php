@extends('layouts.master')
@section('title', 'About Us')
@section('content')
<div class="container container-body">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li class="active">About Us</li>
        </ol>
    </div>
    <div class="row">
        <h2 class="text-center primary-color">About Us</h2>
        <h4>Welcome!</h4>
        <p>Buddhijeevi is derived based on the ideology of making Knowledge easily accessible to everybody. There is a huge wealth of Resources spread across the world and resides in every individual in one form or another. We intend to tap this resources, to be made accessible to other resource(s) who are in need.</p>
        <p>Buddhijeevi is one of its kind Learning community market platform that helps to connect the knowledge seeker to its provider. The Platform will enable seamless coordination with each other by providing wealth of decision enabling information for the seeker to make a right choice, thereby helping him/her with a step closer to the intended goal or destination.</p>
        <br>
        <h4>What is it in for me?</h4>
        <p><strong><strong>Student:</strong></strong>&nbsp;Our aim is to make your learning life easy and fun. Our hand-picked Institutes and Industry led Trainers will make your learning experience effective and help you to bring closer to your goal. You can search for Classes or Institutes closer to your location. We will provide you with real time information of any new Training batch starting with all the information such as Trainer Profile, Course curriculum, Price, Rating, Location, and available job information to enable you to make the right choice. You can make a choice with hundreds of Options available suiting to your needs, requirement and your Dream.</p>
        <h4 class="text-center"><a href="{{URL::to('/')}}" class="primary-color " title="Learn a New Skill" style="text-decoration:underline;">Learn a New Skill</a></h4>
        <p><strong>Institute:</strong>&nbsp;We will help you to build your Brand and stand out. The due recognition you wish to seek for the noble effort of teaching put forward can be fulfilled through this platform. We will enable you to grow your Business with a purpose and satisfaction. Through this platform will help you showcase your Strengths, Expertise and Skillset to the Student community. You can do so by partnering with us by publishing your class today. We will stand together to enable you to be successful through this Journey.</p>
        <h4 class="text-center"><a href="{{URL::to('/course-batch-creation')}}" class="primary-color " title="Start Your Class" style="text-decoration:underline;">Start Your Class</a></h4>
        <p><strong>Trainer/Instructor: </strong>You people are the experts and we will ensure you get all the respect and due recognition you deserve. Our aim is to provide you with plethora of opportunities, to do only one thing that is &ldquo;Your Passion to Teach&rdquo;. We will enable our platform to be a facilitator to take care of all other mundane things and administrative hassle&rsquo;s. Partner with us and see for yourself.</p>
        <h4 class="text-center"><a href="{{URL::to('/account/login')}}" class="primary-color " title="Sign Up" style="text-decoration:underline;">Sign Up</a></h4>
        <p>&nbsp;</p>
        <h4>Buddhijeevi team</strong></h4>
        <p>We are bunch of Passionate individual focused in bringing changes to the Training system of the Country. With the backing of decades of Experience and having field experience in the Training and Skilling domain, we understand the complete ecosystem of all its Players, Standards and Processes.&nbsp;</p>
        <p>We are here to make a difference in enabling Training to be accessible to every Individual of this country. We believe Educating people is the only way to eradicate poverty and improve livelihood and we as a team are committed to it. BuddhiJeevi platform is a stepping stone to set a foundation that will ensure the future education of this country and will set new Standards on how we teach and learn.</p>
        <p>&nbsp;</p>
        <h4>Our team:</strong></h4>        
        <p><strong>ARVIND YARAGUNTI, Founder and Director</strong></p>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <img src="https://dummyimage.com/250x180/696969/fff.jpg&text=" />
                </div>                
                <div class="col-md-9 content-border">
                    <p>Arvind is an alumnus of St. Joseph’s Arts and Science college, Bangalore. He holds a Bachelor degree in Computer Science and Post Graduate Diploma in Computer Application.</p>
                    <p>In his total span of 17 Years in the I.T Industry, he has: </p>
                    <ul>
                        <li>Prior work experiences that includes working with Campus Management Boca USA, Talisma and Oracle with exposure working across multiple Domains and Geographies (US and UK).</li>
                        <li>Played various roles such as Project Manager, Pre-Sales Manager and Solution Architect contributing significantly to both revenues and sales booking through his Product knowledge and domain expertise.</li>
                        <li>He has been Chief Architect of the Skill Development Management system for National Skill Development Corporation(NSDC), and during this phase he envisioned the need for a collaborative Learning Marketplace platform and began the evolution of BuddhiJeevi.</li>
                    </ul>
                    <p>At BuddhiJeevi, Arvind heads the Marketing and Strategy division and is the Architect of BuddhiJeevi platform.</p>        
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <p><strong>MAHADEVI ZALAKI, Co-Founder and Director</strong></p>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <img src="https://dummyimage.com/250x180/696969/fff.jpg&text=" />
                </div>                
                <div class="col-md-9 content-border">
                    <p>Mahadevi brings in a close to a decade long of Client Service experience. She has played an important Role in Airtel and won numerous awards and accolades in Sales and Client Management during her tenure.</p>
                    <p>&nbsp;Mahadevi a.k.a Madhavi heads the Sales and Business Operation division of BuddhiJeevi.</p>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="col-md-12">
            <h4>What does BUDDHIJEEVI mean</h4>
            <p>BuddhiJeevi means an &ldquo;Intellectual&rdquo;, someone who has a deep knowledge about his Trade or Profession. It aligns with our philosophy to enable students to be more knowledgeable.</p>
            <p>&nbsp;</p>
        </div>
    </div>
</div>
@endsection