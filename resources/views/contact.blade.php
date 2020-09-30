<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="">
    <title>{{ config('app.name') }}</title>
</head>
    <body>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <a class="navbar-brand" href="./">Hoque's restaurant</a>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto d-flex justify-content-end">
                <li class="nav-item active">
                  <a class="nav-link" href="./">TOP</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./aboutUs">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./booking">Book</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./contact">Contact</a>
                </li>
              </ul>
            </div>
          </nav>

          <div class="container">
            <h1 class="mt-5 mb-4 title-color text-center">Contact Us</h1>
            <article>
              <form action="" method="POST" class="needs-validation">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col">
                  <label for="first_name">First Name:</label><input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name">
                  @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="col">
                <label for="last_name">Last Name:</label><input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" Placeholder="Last Name">
                  @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                </div>
                  <div class="row">
                    <div class="col">
                      <label for="">Tel#:</label><input type="text" name="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" placeholder="01 23 45 67 89">
                      @error('tel')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col">
                      <label for="">Email:</label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email.address@example.fr">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                  </div>
                    Enquery:<textarea name="enquery" class="form-control" rows="5">{{ old('enquery') }}</textarea><br>
                  <div class="row">
                    <div class="col d-flex justify-content-center">
                      <button type="submit" name="submit" class="btn btn-primary mt-3 col-12" value="confirm">Confirm</button>
                    </div>
                </div>
            </form>
            </article>

            <aside>
              <p>TEL: ○○○-○○○○-○○○○</p>
              <p>Open: ○○:○○~○○:○○</p>
              <p>MAP: </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d44994.27278371845!2d5.680523!3d45.1842207!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478af4f4b38dff7d%3A0xdd66c42bbf04a627!2sMus%C3%A9e%20de%20Grenoble!5e0!3m2!1sfr!2sjp!4v1601459976596!5m2!1sfr!2sjp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </aside>
          </div>
    </body>
</html>