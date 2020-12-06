
				<div class="col-md-8 col-12 py-3">
					<div class="row mb-3">
						<div class="col-6 text-center"><i class="fas fa-arrow-up fa-3x pointer subir"></i></div>
						<div class="col-6 text-center"><i class="fas fa-arrow-down fa-3x pointer bajar"></i></div>
					</div>
		        <?php
		        	// $datos = unserialize(file_get_contents("db.txt"));
		            // var_dump($tareas);

		        	// foreach ($data as $key => $tarea) {
		         //        echo "<li>" . htmlentities($tarea['nombre']) . "</li>";
		        	// }
		        echo '<div id="tareas" data-seleccionado="" class="px-3">';
		        foreach ($tareas as $row){
		        echo "<div class='row justify-content-center' data-id='".$row['id']."'>
		        	 	<div class='col-6 py-1 text-right'><span class='tarea pointer'>"
		        	 	 .  htmlentities($row['nombre']) .
		        	 	"</span></div>
		        	 	<div class='col-6 py-1 text-left'>
		        	 		<i class='fas fa-trash pointer delete fa-2x'></i>
		        	 	</div>";
		        echo '</div>';
				}
		        echo '</div>';


		       	echo form_open('', ['id' => 'add_form']);
		        echo '<div class="form-group">';
		        echo form_label('Nueva tarea', 'nombre');
		        echo form_input(
		        	[
		        		'id' => 'nombre',
		        		'name' => 'nombre',
		        		'placeholder' => 'Nueva Tarea',
		        		'class' => 'form-control',
		        		'required' => 'required',
		        	]);
		        echo '</div>';

		        echo '<div class="form-group">';
		        echo form_label('Orden', 'orden');
		        echo form_input(
		        	[
		        		'id' => 'orden',
		        		'name' => 'orden',
		        		'placeholder' => 'Orden',
		        		'class' => 'form-control',
		        		'required' => 'required',
		        	]);
		        echo '</div>';

		        echo form_submit('add_tarea', 'Añadir Tarea', ['id' => 'add_tarea', 'class' => 'btn btn-dark']);
		        
		        echo form_close();
		        ?>
		        <hr/>
		       
		        Posibles tareas a realizar. Se puede elegir cualquier de ellas en cualquier orden, pero teóricamente están listadas con dificultad creciente:

		        <ul>
		            <li>
		                A esta página, añadirle Bootstrap (o similar), con un diseño base en el que tengamos un menú de la izquierda de la página, que ocupe 12 columnas en móvil y 4 para los demás tamaños, y un cuerpo central que ocupe 12 columnas en móviles y 8 en el resto.
		            </li>
		            <li>
		                Modificar el código PHP (o la tecnología preferida) para que cada "tarea" de la "base de datos" tengo un valor que indique el orden (prioridad).
		            </li>
		            <li>
		                Mostrar el listado en base a ese orden
		            </li>
		            <li>
		                Posibilidad de subir/bajar/eliminar elementos.
		            </li>
		            <li>
		                Añadir posibilidad de crear una nueva tarea.
		            </li>
		            <li>
		                Pasar la lógica de este index y de otras posibles páginas (añadir, bajar/subir, eliminar) a una clase externa, un controlador.
		            </li>
		            <li>
		                Instalar un sistema de templates (Mustache, Twig, etc). Conseguir pintar la página principal con este sistema de templates.
		            </li>
		            <li>
		                Desacoplar lógica de PHP de renderizado. Desde HTML (o tecnología de FRONT que se prefiera) se pedirá vía AJAX los datos a PHP, que responderá con JSONs.
		            </li>            
		        </ul>
    		</div>

    		</div>
    	</div>
    </body>
</html>