<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>404 Error Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta https-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <Style>
    * {
  padding: 0;
  margin: 0;
  outline: 0;
  color: #444;
  box-sizing: border-box;
  font-family: 'IBM Plex Sans', sans-serif;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  overflow: hidden;
}
h1 {
  font-size: 50px;
  line-height: 60px;
}
span {
  display: block;
  font-size: 18px;
  line-height: 30px;
}
.container {
  width: 80%;
  max-width: 1600px;
  margin: auto;
}
.grid-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  place-items: center;
  grid-gap: 50px;
}
.colmun-left {
  text-align: left;
}
.colmun-right {
  text-align: right;
}
.px-spc-b-20 {
  padding-bottom: 20px;
}
button.go-home {
  padding: 5px 20px;
  background: #ffa000;
  border: transparent;
  border-radius: 2px;
  box-shadow: 0 0 2px rgb(0 0 0 / 30%);
  cursor: pointer;
  margin: 20px 0;
  color: #fff;
}
button.go-home i {
  color: #fff;
}
img {
  display: block;
  width: 100%;
}
  </Style>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="grid-row">
      <div class="colmun colmun-left">
        <img src="{{asset('assets/images/image-left.png')}}" alt="image-left">
        <h1 class="px-spc-b-20">We can't find the page you are looking for.</h1>
        <span class="px-spc-b-20">Oops! The requested page could not be found.</span>

        <button class="go-home"  onclick="history.back()"><i class="fa fa-home"></i> Go Back</button>
      </div>
      <div class="colmun colmun-right">
        <img src="{{asset('assets/images/right-shape.png')}}" alt="right-shape">
      </div>
    </div>
  </div>
</div>
</body>
</html>