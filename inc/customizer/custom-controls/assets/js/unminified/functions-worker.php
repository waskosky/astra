/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_script( 'astra-worker-theme-js', get_stylesheet_directory_uri() . '/worker.js', array('astra-worker-js'), '1.0.0', 'all' );

}

// add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

// add_action( 'wp_footer', 'function_worker' );

function function_worker() {
	?>
	<h1>Web<br>Workers<br>basic<br>example</h1>

	<div class="controls" tabindex="0">

	<form>
		<div>
		<label for="number1">Multiply number 1: </label>    
		<input type="text" id="number1" value="0">
		</div>
		<div>
		<label for="number2">Multiply number 2: </label>   
		<input type="text" id="number2" value="0">
		</div>
	</form>

	<p class="result">Result: 0</p>

	</div>
	<script>
		const first = document.querySelector('#number1');
		const second = document.querySelector('#number2');

		const result = document.querySelector('.result');

		if (window.Worker) {
			const myWorker = new Worker("http://localhost:8080/customizer/wp-content/themes/astra/worker.js");

			first.onchange = function() {
			myWorker.postMessage([first.value, second.value]);
			console.log('Message posted to worker');
			}

			second.onchange = function() {
			myWorker.postMessage([first.value, second.value]);
			console.log('Message posted to worker');
			}

			myWorker.onmessage = function(e) {
				result.textContent = e.data;
				console.log('Message received from worker');
			}
		} else {
			console.log('Your browser doesn\'t support web workers.')
		}
	</script>
	<?php
}