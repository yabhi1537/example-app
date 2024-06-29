<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin-bottom: 60px;
        /* Height of the footer */
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* Height of the footer */
        background-color: #f5f5f5;
    }

    p.card-text {
        margin-top: -10px;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Weather App</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-5 mb-4">Weather Application</h1>
        <div class="input-group mb-3">
            <form action="{{ route('weather.form') }}" method="post" class="form-inline">
               @csrf
                <div class="d-flex">
                    <div class="form-group">
                        <select class="form-select" name="city" id="city">
                            <option value="-1">-- Select City --</option>
                            <option value="Port Blair">Port Blair</option>
                            <option value="Guna">Guna</option>
                            <option value="Bhopal">Bhopal</option>
                            <option value="Chapra">Chapra</option>
                        </select>
                    </div>
                    <button style="margin-left: 20px;" class="btn btn-primary">Search</button>
                </div>
            </form>

        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Looks Like</h5>
                        <br>
                        @if(isset($data['weather'][0]['main']) && $data['weather'][0]['main'] == "Clear")
                            <img src="./images/clear.png" alt="" style="height: 100px;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Location Details</h5>
                        <br>
                        <p class="card-text">Country: 
                            <b> 
                                @if(isset($data["sys"]['country'])) 
                                    {{ $data["sys"]['country'] }} 
                                @else
                                  --    
                                @endif 
                            </b>
                        </p>
                        <p class="card-text">Name: 
                                @if(isset($data["name"])) 
                                    {{ $data["name"] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Latitude: 
                                @if(isset($data["coord"]['lat'])) 
                                    {{ $data["coord"]['lat'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Longitude: 
                                @if(isset($data["coord"]['lon'])) 
                                    {{ $data["coord"]['lon'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Sunrise: 
                                @if(isset($data["sys"]['sunrise'])) 
                                    {{ $data["sys"]['sunrise'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Sunset: 
                                @if(isset($data["sys"]['sunset'])) 
                                    {{ $data["sys"]['sunset'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Temperature  &deg; F</h5>
                        <br>
                        <p class="card-text">Temp: 
                                @if(isset($data["main"]['temp'])) 
                                    {{ $data["main"]['temp'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Min Temp: 
                                @if(isset($data["main"]['temp_min'])) 
                                    {{ $data["main"]['temp_min'] }} 
                                @else
                                  --    
                                @endif
                        </p>
                        <p class="card-text">Max Temp: <b>--</b></p>
                        <p class="card-text">Feels Like: <b>--</b></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Precipitation &percnt;</h5>
                        <br>
                        <p class="card-text">Humidity: <b>--</b></p>
                        <p class="card-text">Pressure: <b>--</b></p>
                        <p class="card-text">Sea Level: <b>--</b></p>
                        <p class="card-text">Ground Level: <b>--</b></p>
                        <p class="card-text">Visibility: <b>--</b></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Wind m/h</h5>
                        <br>
                        <p class="card-text">Speed: <b>--</b></p>
                        <p class="card-text">Degree: <b>--</b></p>
                        <p class="card-text">Gust: <b>--</b></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">© 2024 Weather App. All rights reserved.</span>
        </div>
    </footer>
</body>

</html>