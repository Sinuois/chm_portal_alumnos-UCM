<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	#MALLA INF
    	#PRIMER SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-111',
        	'nombre'=>'Algebra I',
        	'creditos'=>'8',
			'semestre'=>'1',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-112',
        	'nombre'=>'Cálculo I',
        	'creditos'=>'8',
			'semestre'=>'1',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-113',
        	'nombre'=>'Introduccion a la Computacion',
        	'creditos'=>'6',
			'semestre'=>'1',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-114',
        	'nombre'=>'Introduccion a la Ingenieria',
        	'creditos'=>'5',
			'semestre'=>'1',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'IFG-100',
        	'nombre'=>'Ingles I',
        	'creditos'=>'3',
			'semestre'=>'1',
			'seccion'=>'2',
        	]);
        #SEGUNDO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-121',
        	'nombre'=>'Algebra II',
        	'creditos'=>'8',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-122',
        	'nombre'=>'Calculo II',
        	'creditos'=>'8',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-123',
        	'nombre'=>'Programacion',
        	'creditos'=>'8',
			'semestre'=>'2',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-124',
        	'nombre'=>'Comprension Lectora y Prod. de Textos',
        	'creditos'=>'3',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'IFG-200',
        	'nombre'=>'Ingles II',
        	'creditos'=>'3',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
        #TERCER SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-211',
        	'nombre'=>'Fisica I',
        	'creditos'=>'6',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-212',
        	'nombre'=>'Calculo III',
        	'creditos'=>'6',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-213',
        	'nombre'=>'Estructura de datos',
        	'creditos'=>'6',
			'semestre'=>'3',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-214',
        	'nombre'=>'Expresion Oral en Ingenieria',
        	'creditos'=>'3',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-215',
        	'nombre'=>'Circuitos Digitales',
        	'creditos'=>'6',
			'semestre'=>'3',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'IFG-300',
        	'nombre'=>'Ingles III',
        	'creditos'=>'3',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
        #CUARTO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-221',
        	'nombre'=>'Fisica II',
        	'creditos'=>'6',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-222',
        	'nombre'=>'Ecuaciones Diferenciales',
        	'creditos'=>'5',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-223',
        	'nombre'=>'Programacion Avanzada',
        	'creditos'=>'5',
			'semestre'=>'4',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-224',
        	'nombre'=>'Logica para la Ciencia de la Computacion',
        	'creditos'=>'4',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-225',
        	'nombre'=>'Arquitectura de Computadores',
        	'creditos'=>'5',
			'semestre'=>'4',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-226',
        	'nombre'=>'Modulo Integrador Ciencias Basicas',
        	'creditos'=>'5',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
        #QUINTO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-311',
        	'nombre'=>'Fisica III',
        	'creditos'=>'5',
			'semestre'=>'5',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-312',
        	'nombre'=>'Inferencia Estadistica',
        	'creditos'=>'6',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-313',
        	'nombre'=>'Estructuras Discretas',
        	'creditos'=>'5',
			'semestre'=>'5',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-314',
        	'nombre'=>'Modelamiento de Datos',
        	'creditos'=>'5',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-315',
        	'nombre'=>'Taller de Circuitos Digitales',
        	'creditos'=>'4',
			'semestre'=>'5',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'MFG-114',
        	'nombre'=>'Introduccion a la Fe',
        	'creditos'=>'5',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
        #SEXTO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-321',
        	'nombre'=>'Computacion Numerica',
        	'creditos'=>'4',
			'semestre'=>'6',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-322',
        	'nombre'=>'Investigacion de Operaciones',
        	'creditos'=>'5',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-323',
        	'nombre'=>'Teoria de la Computacion',
        	'creditos'=>'5',
			'semestre'=>'6',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-324',
        	'nombre'=>'Base de Datos',
        	'creditos'=>'6',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-325',
        	'nombre'=>'Sistemas Operativos',
        	'creditos'=>'5',
			'semestre'=>'6',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'MFG-216',
        	'nombre'=>'Etica Cristiana',
        	'creditos'=>'5',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
        #SEPTIMO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-411',
        	'nombre'=>'Metodologia de la Investigacion',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-412',
        	'nombre'=>'Economia',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-413',
        	'nombre'=>'Diseño y Analisis de Algoritmos',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-414',
        	'nombre'=>'Sistemas de Informacion',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-415',
        	'nombre'=>'Comunicacion de Datos y Redes',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
        #OCTAVO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-421',
        	'nombre'=>'Modulo Integrador de Licenciatura (practica 1: inicial)',
        	'creditos'=>'8',
			'semestre'=>'8',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-422',
        	'nombre'=>'Contabilidad y Finanzas',
        	'creditos'=>'4',
			'semestre'=>'8',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-423',
        	'nombre'=>'Inteligencia Artificial',
        	'creditos'=>'4',
			'semestre'=>'8',
			'seccion'=>'2',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-424',
        	'nombre'=>'Ingenieria de Software I',
        	'creditos'=>'5',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
        DB::table('cursos')->insert([
        	'codigo'=>'INF-425',
        	'nombre'=>'Redes Avanzadas',
        	'creditos'=>'4',
			'semestre'=>'8',
			'seccion'=>'2',
        	]);
        #NOVENO SEMESTRE
        DB::table('cursos')->insert([
        	'codigo'=>'INF-511',
        	'nombre'=>'Form. y Eval de Proyectos Informaticos',
        	'creditos'=>'5',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-512',
        	'nombre'=>'Gestion Informatica I',
        	'creditos'=>'5',
			'semestre'=>'9',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-513',
        	'nombre'=>'Calidad y Productividad de Software',
        	'creditos'=>'5',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-514',
        	'nombre'=>'Ingeniaria de Software II',
        	'creditos'=>'5',
			'semestre'=>'9',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-515',
        	'nombre'=>'Sistemas Distribuidos',
        	'creditos'=>'5',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		#DECIMO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'INF-521',
        	'nombre'=>'Recursos Humanos y Legislacion',
        	'creditos'=>'5',
			'semestre'=>'10',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-522',
        	'nombre'=>'Gestion Informatica II',
        	'creditos'=>'5',
			'semestre'=>'10',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-523',
        	'nombre'=>'Electivo',
        	'creditos'=>'5',
			'semestre'=>'10',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-524',
        	'nombre'=>'Taller de Desarrollo de Software',
        	'creditos'=>'5',
			'semestre'=>'10',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-525',
        	'nombre'=>'Seguridad de la Informacion',
        	'creditos'=>'5',
			'semestre'=>'10',
			'seccion'=>'2',
        	]);
		#ONCEAVO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'INF-611',
        	'nombre'=>'Electivo II',
        	'creditos'=>'5',
			'semestre'=>'11',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-612',
        	'nombre'=>'Electivo III',
        	'creditos'=>'5',
			'semestre'=>'11',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'INF-613',
        	'nombre'=>'Modulo Integrador Formacion Profesional (Practica 2: Profesional)',
        	'creditos'=>'5',
			'semestre'=>'11',
			'seccion'=>'1',
        	]);
		#----------------------------------------------------------------------------------------------
		#MALLA ANTIGUA
		#PRIMER SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-115',
        	'nombre'=>'Algebra I',
        	'creditos'=>'10',
			'semestre'=>'1',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-116',
        	'nombre'=>'Calculo I',
        	'creditos'=>'10',
			'semestre'=>'1',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-117',
        	'nombre'=>'Introd. a la Computacion',
        	'creditos'=>'8',
			'semestre'=>'1',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-114',
        	'nombre'=>'Introd. a la Ingenieria',
        	'creditos'=>'8',
			'semestre'=>'1',
			'seccion'=>'1',
        	]);
		#SEGUNDO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-126',
        	'nombre'=>'Algebra Lineal',
        	'creditos'=>'10',
			'semestre'=>'2',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-123',
        	'nombre'=>'Fisica I',
        	'creditos'=>'10',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-127',
        	'nombre'=>'Calculo II',
        	'creditos'=>'10',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-128',
        	'nombre'=>'Leng. de Programacion',
        	'creditos'=>'8',
			'semestre'=>'2',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-118',
        	'nombre'=>'Ingles I',
        	'creditos'=>'4',
			'semestre'=>'2',
			'seccion'=>'1',
        	]);
		#TERCER SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-217',
        	'nombre'=>'Algebra Abstracta',
        	'creditos'=>'8',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-212',
        	'nombre'=>'Fisica II',
        	'creditos'=>'9',
			'semestre'=>'3',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-213',
        	'nombre'=>'Estadistica y Probabilidad',
        	'creditos'=>'10',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-214',
        	'nombre'=>'Arquitectura de Computad. I',
        	'creditos'=>'8',
			'semestre'=>'3',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-215',
        	'nombre'=>'Estructura de Datos',
        	'creditos'=>'9',
			'semestre'=>'3',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-216',
        	'nombre'=>'Tec. Expresion Oral y Escrita',
        	'creditos'=>'5',
			'semestre'=>'3',
			'seccion'=>'1',
        	]);
		#CUARTO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-221',
        	'nombre'=>'Calculo III',
        	'creditos'=>'9',
			'semestre'=>'4',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-222',
        	'nombre'=>'Transmision de Datos',
        	'creditos'=>'8',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-223',
        	'nombre'=>'Arquitec. de Computad. II',
        	'creditos'=>'8',
			'semestre'=>'4',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-224',
        	'nombre'=>'Org. y Manejo de Archivos',
        	'creditos'=>'8',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-225',
        	'nombre'=>'Economia',
        	'creditos'=>'6',
			'semestre'=>'4',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-227',
        	'nombre'=>'Ingles II',
        	'creditos'=>'4',
			'semestre'=>'4',
			'seccion'=>'1',
        	]);
		#QUINTO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-311',
        	'nombre'=>'Ecuaciones Diferenciales',
        	'creditos'=>'9',
			'semestre'=>'5',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-312',
        	'nombre'=>'Sistemas Operativos',
        	'creditos'=>'10',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-313',
        	'nombre'=>'Modelamientos de Datos',
        	'creditos'=>'10',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-314',
        	'nombre'=>'Contabilidad y Costos',
        	'creditos'=>'10',
			'semestre'=>'5',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'MFG-113',
        	'nombre'=>'Introduccion a la Fe',
        	'creditos'=>'8',
			'semestre'=>'5',
			'seccion'=>'1',
        	]);
		#SEXTO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-328',
        	'nombre'=>'Calculo Numerico',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-329',
        	'nombre'=>'Redes de Computacion',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-330',
        	'nombre'=>'Sistemas de Informacion I',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-324',
        	'nombre'=>'Base de Datos',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-325',
        	'nombre'=>'Sistemas de Gestion I',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'MFG-214',
        	'nombre'=>'Etica Cristiana',
        	'creditos'=>'8',
			'semestre'=>'6',
			'seccion'=>'1',
        	]);
		#SEPTIMO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-411',
        	'nombre'=>'Inferencia Estadistica',
        	'creditos'=>'9',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-412',
        	'nombre'=>'Mecanica',
        	'creditos'=>'9',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-416',
        	'nombre'=>'Sistemas de Informacion II',
        	'creditos'=>'9',
			'semestre'=>'7',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-417',
        	'nombre'=>'Ingenieria de Software I',
        	'creditos'=>'8',
			'semestre'=>'7',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-415',
        	'nombre'=>'Legislacion Laboral',
        	'creditos'=>'6',
			'semestre'=>'7',
			'seccion'=>'2',
        	]);
		#OCTAVO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-427',
        	'nombre'=>'Matematica Discreta',
        	'creditos'=>'9',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-422',
        	'nombre'=>'Electromagnetismo',
        	'creditos'=>'9',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-423',
        	'nombre'=>'Invest. de Operaciones',
        	'creditos'=>'8',
			'semestre'=>'8',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-424',
        	'nombre'=>'Ingenieria de Software II',
        	'creditos'=>'9',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-425',
        	'nombre'=>'Ingenieria Economica',
        	'creditos'=>'6',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-426',
        	'nombre'=>'Recursos y Rela-Hum',
        	'creditos'=>'6',
			'semestre'=>'8',
			'seccion'=>'1',
        	]);
		#NOVENO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-511',
        	'nombre'=>'Circuitos Digitales',
        	'creditos'=>'9',
			'semestre'=>'9',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-512',
        	'nombre'=>'Teoria Automata',
        	'creditos'=>'9',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-513',
        	'nombre'=>'Aud. y Seg. Sistemas',
        	'creditos'=>'6',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-514',
        	'nombre'=>'Comunicacion Hom-Maq',
        	'creditos'=>'7',
			'semestre'=>'9',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-515',
        	'nombre'=>'SIstemas de Gestion II',
        	'creditos'=>'8',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-516',
        	'nombre'=>'Evaluacion de Proyectos',
        	'creditos'=>'8',
			'semestre'=>'9',
			'seccion'=>'1',
        	]);
		#DECIMO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-521',
        	'nombre'=>'Metodos Formales',
        	'creditos'=>'10',
			'semestre'=>'10',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-522',
        	'nombre'=>'Analisis de Algoritmos',
        	'creditos'=>'10',
			'semestre'=>'10',
			'seccion'=>'2',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-524',
        	'nombre'=>'Calidad y Prod. Software',
        	'creditos'=>'10',
			'semestre'=>'10',
			'seccion'=>'1',
        	]);
		#ONCEAVO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-611',
        	'nombre'=>'Sistemas Distribuidos',
        	'creditos'=>'10',
			'semestre'=>'11',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-612',
        	'nombre'=>'Inteligencia Artificial',
        	'creditos'=>'10',
			'semestre'=>'11',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-613',
        	'nombre'=>'Computacion Grafica',
        	'creditos'=>'8',
			'semestre'=>'11',
			'seccion'=>'2',
        	]);
		#DOCEAVO SEMESTRE
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-621',
        	'nombre'=>'Tesis',
        	'creditos'=>'30',
			'semestre'=>'12',
			'seccion'=>'1',
        	]);
		DB::table('cursos')->insert([
        	'codigo'=>'ICI-622',
        	'nombre'=>'Practica Profesional',
        	'creditos'=>'20',
			'semestre'=>'12',
			'seccion'=>'2',
        	]);

	}        	
}