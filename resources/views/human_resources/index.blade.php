@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
	<div class="container">

		<div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
			<div class="box box-primary pad">
				<h1>Show a Dashboard <i class='fa fa-dashboard'></i></h1>
				<ul class="list-group">
					<li class="list-group-item">Head Count General</li>
					<li class="list-group-item">Head Count by Project. Link to a details by position</li>
					<li class="list-group-item">Head Count by Project/position. Link to a details by employee</li>
					<li class="list-group-item">Head Count by Supervisor. Link to a details by employee</li>
				</ul>	
				
				<p>{{ $dashboard->by_department }}</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iure soluta repellendus. Ex nemo, magni totam ad quas, aliquid! Officiis mollitia doloremque et quos numquam quod blanditiis ducimus laborum odit.</p>
				<p>Perferendis fuga quasi non, modi possimus nemo in libero natus, inventore ipsam assumenda pariatur est veritatis dolorum facilis amet similique asperiores? Quia maxime, illum laborum voluptas qui, explicabo rerum velit?</p>
				<p>Illo consectetur accusantium, optio quod facere neque nostrum asperiores aut voluptates soluta quae, quos quidem necessitatibus, natus totam fuga dolore veritatis dolores. Minus repudiandae incidunt, quibusdam explicabo sapiente dicta veritatis?</p>
				<p>Rem deleniti ipsa illo in alias quia minima error aliquid dolores? Optio natus laborum voluptates soluta ad sunt recusandae tempore deserunt alias, porro, dolore nam voluptatem quam temporibus eius autem.</p>
				<p>Nulla dolor ad atque ducimus molestias repudiandae commodi numquam quidem at illo fugiat possimus aperiam est, sit amet quisquam optio obcaecati! Nisi, mollitia officiis sunt culpa temporibus nesciunt impedit doloremque?</p>
				<p>Laudantium dolor, velit facilis numquam cupiditate error delectus accusantium reprehenderit animi officia modi, sapiente quia minima eius ratione at possimus? Laboriosam magnam deserunt sequi mollitia minima nisi vitae totam praesentium!</p>
				<p>Neque magnam temporibus, delectus laudantium, esse illo! Cumque, officiis. Incidunt laboriosam ipsum quos. Inventore explicabo quaerat rerum error sed iste at vel, obcaecati fuga voluptatum! Molestias architecto repellendus, fuga tenetur.</p>
				<p>Ducimus laudantium ratione vero esse officiis placeat a commodi qui et dolores assumenda nesciunt, ex reprehenderit dolor blanditiis nemo eveniet consectetur similique modi at eum, aperiam quaerat, nobis! Incidunt, architecto!</p>
			</div>
		</div>	
	</div>
@stop

			