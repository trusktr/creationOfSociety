<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Muah hah hah</title>
		<?php
			if (!isset($_REQUEST['dev'])) {
				?><script>window.location.href = ''+location.protocol+'//'+location.host+'/wp';</script><?php
			}
		?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="x.css">
	</head>
	<body class="home page page-id-2 page-template-default logged-in admin-bar custom-background singular two-column right-sidebar">

		<div id="x"></div>
		
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script src="three.js"></script>
		<script src="RequestAnimationFrame.js"></script>
		<script src="Stats.js"></script>
		<script>

			var container, stats = false;

			var camera, scene, renderer;

			var cube, plane;

			var targetRotation = 0;
			var targetRotationOnMouseDown = 0;

			var mouseX = 0;
			var mouseXOnMouseDown = 0;

			var windowHalfX = $(container).width() / 2;
			var windowHalfY = $(container).height() / 2;

			function init() {

				container = document.createElement( 'div' );
				$(container).attr('id', 'cubeLoader');
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 50, $(container).width() / ($(container).height()-175), 1, 1000 );
				camera.position.y = 150;
				camera.position.z = 550;

				scene = new THREE.Scene();

				// Cube

				var materials = [];

				for ( var i = 0; i < 6; i ++ ) {

					materials.push( [
						new THREE.MeshBasicMaterial(
							/*{ color: Math.random() * 0xffffff }*/ // Random Colors for the sides.
							{ map: THREE.ImageUtils.loadTexture( 'creation-of-society-llc1.jpg' ) } // Image mapped to each side.
						)
					] );

				}

				cube = new THREE.Mesh( new THREE.CubeGeometry( 200, 200, 200, 10, 10, 10, materials ), new THREE.MeshFaceMaterial() );
				cube.position.y = 150;
				cube.overdraw = true;
				scene.add( cube );

				// Plane

				plane = new THREE.Mesh( new THREE.PlaneGeometry( 200, 200 ), new THREE.MeshBasicMaterial( { color: 0xe0e0e0 } ) );
				plane.rotation.x = - 90 * ( Math.PI / 180 );
				plane.overdraw = true;
				scene.add( plane );

				renderer = new THREE.CanvasRenderer();
				renderer.setSize( $(container).width(), $(container).height()-175 );

				container.appendChild( renderer.domElement );

				if (stats) {
					stats = new Stats();
					stats.domElement.style.position = 'absolute';
					$(stats.domElement).attr('id', 'statsBox');
					stats.domElement.style.top = '0px';
					container.appendChild( stats.domElement );
				}

				var info = document.createElement( 'div' );
//				info.style.position = 'absolute';
//				info.style.top = '10px';
				info.style.width = '100%';
				info.style.textAlign = 'center';
				info.innerHTML = 'Loading...';
				container.appendChild( info );

				document.addEventListener( 'mousedown', onDocumentMouseDown, false );
				document.addEventListener( 'touchstart', onDocumentTouchStart, false );
				document.addEventListener( 'touchmove', onDocumentTouchMove, false );
			}

			//

			function onDocumentMouseDown( event ) {

//				event.preventDefault();

//				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
//				document.addEventListener( 'mouseup', onDocumentMouseUp, false );
//				document.addEventListener( 'mouseout', onDocumentMouseOut, false );

//				mouseXOnMouseDown = event.clientX - windowHalfX;
//				targetRotationOnMouseDown = targetRotation;
			}

			function onDocumentMouseMove( event ) {

//				mouseX = event.clientX - windowHalfX;

//				targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.02;
			}

			function onDocumentMouseUp( event ) {

//				document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
//				document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
//				document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
			}

			function onDocumentMouseOut( event ) {

//				document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
//				document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
//				document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
			}

			function onDocumentTouchStart( event ) {

//				if ( event.touches.length == 1 ) {

//					event.preventDefault();

//					mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
//					targetRotationOnMouseDown = targetRotation;

//				}
			}

			function onDocumentTouchMove( event ) {

//				if ( event.touches.length == 1 ) {

//					event.preventDefault();

//					mouseX = event.touches[ 0 ].pageX - windowHalfX;
//					targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.05;

//				}
			}

			//

			function animate() {

				requestAnimationFrame( animate );

				render();
				if (stats) stats.update();
			}

			function render() {
//				plane.rotation.z = cube.rotation.y += ( targetRotation - cube.rotation.y ) * 0.05;
				plane.rotation.z = cube.rotation.y += 0.025;
				renderer.render( scene, camera );

			}

			$(document).on('ready', function() {
				init();
				animate();
			});

		</script>
		
		<script src="x.js"></script>

	</body>
</html>
