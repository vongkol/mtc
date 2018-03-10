<!DOCTYPE html>
<head>

<title>Print CV</title>

<style type="text/css">
html {
    background: white;
    color: black;
    font: 14px 'Helvetica Neue', Arial, sans-serif;
}
body {
    margin: 2em auto;
    max-width: 760px;
    width: 65%;
}
.hr-title {
    text-align: center;
    color: orange;
    margin: -35px;
}
.uppercase {
    text-transform: uppercase;
    text-decoration: underline;
}
section {
    clear: both;
    margin-top: 3em;
}
li {
    list-style-type: disc;
}
.name-cv {
    text-transform: uppercase;
}
section > ul > li,
header > ul > li {
    list-style-type: none;
    margin-bottom: .5em;
}
.headline-name {
    border-bottom: 1px solid black;
    padding-bottom: .5em;
}
.contact-column {
    float: left;
    padding: 0 1px;
}
a,
a:link,
a:visited {
    border-bottom: 1px dotted rgb(0, 120, 180);
    color: rgb(0, 120, 180);
    padding: .2em .1em;
    text-decoration: none;
}
a:focus,
a:hover,
a:active {
    background-color: rgb(255, 245, 0);
    border-bottom: 1px solid rgb(0, 120, 180);
    color: rgb(0, 120, 180);
}
.padding {
    padding: 35px;
}
.logo-p-cv {
    margin-left: 30px;
}
@media (min-width: 992px) {
    .contact-column {
        margin-left: 1em;
    }
    .contact-column.right {
        float: right;
    }
}
@media (max-width: 776px) {
    ul {
        margin-left: 0;
        margin-right: 0;
        padding-left: 0;
        padding-right: 0;
    }
}
@media print {
    html {
        color: black;
        font-size: 12px;
    }
    body {
        margin: 1.5em;
        width: 90%;
    }
    section {
        margin-top: 1em;
    }
    a,
    a:link,
    a:visited {
        border: none;
        color: black;
    }
}
</style>

</head>
<body>
	<header>
        @foreach($logo as $l)
            <div class="logo-p-cv">
                <img src="{{URL::asset('/img/').'/'.$l->photo}}">
            </div>
        @endforeach
        <h2 class="hr-title">HR ANGKOR CO., LTD</h2>
        <div class="padding"></div>
		<h3 class="name-cv">{{$cv->last_name}} {{$cv->first_name}}</h3>
		<ul id="header-left" title="mail and phone">
            <li>{!!$cv->cv_head!!}</li>
		</ul>
	</header>
    <section><h3 class="uppercase">EDUCATION BACKGROUND:</h3>
		<ul title="work experience">
		<li>
            {!!$cv->education!!}
       	</li>
		</ul>
	</section>
	<section><h3 class="uppercase">WORK EXPERIENCE:</h3>
		<ul title="work experience">
		<li>
            {!!$cv->experience!!}
       	</li>
		</ul>
	</section>
	<section><h3 class="uppercase">TRAINING COURSE:</h3>
        <ul title="training course">
            <li>{!!$cv->training!!}</li>
        </ul>
	</section>
    <section><h3 class="uppercase">KNOWLEDGE OF LANGUAGE:</h3>
        <ul title="knowledge of language">
            <li>{!!$cv->language!!}</li>
        </ul>
	</section>
    <section><h3 class="uppercase">OTHER SKILL:</h3>
        <ul title="other skill">
            <li>{!!$cv->other_skill!!}</li>
        </ul>
	</section>
    <section><h3 class="uppercase">HOBBIES:</h3>
        <ul title="hobbies">
            <li>{!!$cv->other_skill!!}</li>
        </ul>
	</section>
</body>
</html>