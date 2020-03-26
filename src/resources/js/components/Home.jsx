import React from 'react';
import ReactDOM from 'react-dom';

class CurrentWeather extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			
		};
	}

	componentDidMount() {
		let weatherIcon = window.Skycons.CLEAR_NIGHT
		switch(this.props.darkSky.currently.icon) {
			case 'clear-night': weatherIcon = window.Skycons.CLEAR_NIGHT; break;
			case 'clear-day': weatherIcon = window.Skycons.CLEAR_DAY; break;
			case 'rain': weatherIcon = window.Skycons.RAIN; break;
			case 'fog': weatherIcon = window.Skycons.FOG; break;
			case 'cloudy': weatherIcon = window.Skycons.CLOUDY; break;
			case 'partly-cloudy-day': weatherIcon = window.Skycons.PARTLY_CLOUDY_DAY; break;
			case 'partly-cloudy-night': weatherIcon = window.Skycons.PARTLY_CLOUDY_NIGHT; break;
			case 'sleet': weatherIcon = window.Skycons.SLEET; break;
			case 'snow': weatherIcon = window.Skycons.SNOW; break;
			case 'wind': weatherIcon = window.Skycons.WIND; break;
		}
		skycons.set('icon-weather', weatherIcon);
	}

	render() {
		let curr = this.props.darkSky.currently;

		

		//skycons.set('icon-weather', weatherIcon);
		
		return (

			<div className="row align-items-center h-100">
				<div className="col-md-4 text-center">
					<div className="weather-title">
						{curr.summary}
					</div>
				</div>
				<div className="col-md-4 text-center">
					<canvas id="icon-weather" width="128" height="128"></canvas>
				</div>
				<div className="col-md-4 text-center">
					<div className="weather-title">
						{Math.round(curr.temperature)}°F
					</div>
				</div>

			</div>
		);
	}
}

class OskWeather extends React.Component {

	constructor(props) {
    	super(props);
    	this.state = {
    		value: '',
    		currentWeather: null

    	};

    	this.handleChange = this.handleChange.bind(this);
    	this.handleSubmit = this.handleSubmit.bind(this);
  	}

	handleChange(event) {
		this.setState({value: event.target.value});
	}

	handleSubmit(e) {
		fetch('https://public.opendatasoft.com/api/records/1.0/search/?dataset=us-zip-code-latitude-and-longitude&q=' + encodeURIComponent(this.state.value)+ '&facet=state&facet=timezone&facet=dst').then((res) => {
			return res.json();
		}).then((data) => {
    		console.log('data', data);
    		console.log(data.records[0].geometry.coordinates);
    		let location = data.records[0].geometry.coordinates;
    		fetch(WEATHER_URL + '?lo=' + location[0] + '&la=' + location[1]).then((res) => {
    			return res.json();
    		}).then((data) => {
    			console.log('local weather ', data);
    			this.setState({currentWeather: <CurrentWeather darkSky={data}/>})

    		});

  		});
		
		e.preventDefault();
	}

  	getWeather(e) {
		e.preventDefault();
		
	}


	render() {
		return (
			<div className="container">
				<div className="title m-b-md">
						Osky Weather
				</div>

				<div className="row justify-content-center">
	                <div className="col-md-12">
	                    <div className="card">
	                        <div className="card-header">Enter a City or Postal code</div>

	                        <div className="card-body">

	                        	<div className="input-group mb-1">
	                        		<form className="form-inline" onSubmit={this.handleSubmit}>
		  								<input type="text" value={this.state.value} onChange={this.handleChange}className="form-control" placeholder="Seattle, WA" aria-label="City or Postal Code" aria-describedby="btn-get-weather" />
	  									<div className="input-group-append">
			    							<button onClick={this.handleSubmit} className="btn btn-outline-secondary" type="submit" id="btn-get-weather">Get Local Weather</button>
	  									</div>
	  								</form>
								</div>

								
								{this.state.currentWeather}

	                        </div>
	                    </div>
	                </div>
	            </div>

	            <div className="row">
	            	<div className="footer">
						<p>This site is powered by the following Services, APIs and Frameworks.</p>
						<div className="links ">
							<a href="https://laravel.com/" target="_blank">Laravel</a>
							<a href="https://darksky.net/" target="_blank">Dark Sky</a>
							<a href="https://opendatasoft.com/" target="_blank">opendatasoft</a>
							
						</div>
					</div>
				</div>

			</div>
		);
	}
}

export default OskWeather;

if (document.getElementById('osky-weather')) {
	ReactDOM.render(<OskWeather />, document.getElementById('osky-weather'));
}
