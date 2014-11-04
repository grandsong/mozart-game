// *** Parameters ***
var DEBUG = true;
var BARS_COUNT = 16;

// *** Constants ***
var dir = "./mp3/";
var ext = ".mp3"

// *** Global variables ***
var song = new Array();
var playing = new Array();
var type = 'M'; // Type value M - minuet, T - trio
var loaded = new Array(BARS_COUNT);

// minuet[row][col]
var minuet = [
	[ 96, 22,141, 41,105,122, 11, 30, 70,121, 26,  9,112, 49,109, 14],
	[ 32,  6,128, 63,146, 46,134, 81,117, 39,126, 56,174, 18,116, 83],
	[ 69, 95,158, 13,153, 55,110, 24, 66,139, 15,132, 73, 58,145, 79],
	[ 40, 17,113, 85,161,  2,159,100, 90,176,  7, 34, 67,160, 52,170],
	[148, 74,163, 45, 80, 97, 36,107, 25,143, 64,125, 76,136,  1, 93],
	[104,157, 27,167,154, 68,118, 91,138, 71,150, 29,101,162, 23,151],
	[152, 60,171, 53, 99,133, 21,127, 16,155, 57,175, 43,168, 89,172],
	[119, 84,114, 50,140, 86,169, 94,120, 88, 48,166, 51,115, 72,111],
	[ 98,142, 42,156, 75,129, 62,123, 65, 77, 19, 82,137, 38,149,  8],
	[  3, 87,165, 61,135, 47,147, 33,102,  4, 31,164,144, 59,173, 78],
	[ 54,130, 10,103, 28, 37,106,  5, 35, 20,108, 92, 12,124, 44,131]
];
// trio[row][col]
var trio = [
	[72, 6,59,25,81,41,89,13,36, 5,46,79,30,95,19,66],
	[56,82,42,74,14, 7,26,71,76,20,64,84, 8,35,47,88],
	[75,39,54, 1,65,43,15,80, 9,34,93,48,69,58,90,21],
	[40,73,16,68,29,55, 2,61,22,67,49,77,57,87,33,10],
	[83, 3,28,53,37,17,44,70,63,85,32,96,12,23,50,91],
	[18,45,62,38, 4,27,52,94,11,92,24,86,51,60,78,31]
];

// *** Functions ****

/**
 * @brief Control if variable exists and if is not null
 * @details Helper function for debugging and integrity checking.
 * 
 * @param variable Content of variable
 * @throw ReferenceError
 */
function var_exist(variable) {
	if(variable == undefined || variable == null) {
		alert("ERROR: Script not working properly!");
		throw "Variable \""+variable+"\" not defined or null!";
	}
}

/**
 * @brief Return jQuery object from html element with id
 * 
 * @param  id id for html element
 * @return jQuery object
 */
function html_get(id) {
	debug("html_get("+id+")")
	var element = $("#"+id);
	if(element.length <= 0 || element == undefined || element == null) {
		alert("ERROR: Page not loaded properly!");
		throw "HTML element "+id+" not found!";
	}
	return element;
}

/**
 * @brief Function for print debug to javascript console.
 * 
 * @param  text Text for debugging
 */
function debug(text) {
	if(!DEBUG) return;
	console.log(text);
}

/**
 * @brief Change bar of generated song
 * 
 * @param  id Id of current editated bar
 */ 
function bar_change(id) {
	var_exist(id);
}

function type_switch() {
	var type_name = $("#type .active").html();
	debug("type_name: "+type_name+" old type: "+type);
	var div_minuets = html_get("minuets");
	var div_trios = html_get("trios");
	switch(type_name){
		case "Minuet":
			type = "M";
			// Hide trio, show minuet
			div_trios.hide();
			div_minuets.show();
			break;
		case "Trio":
			type = "T";
			div_minuets.hide();
			div_trios.show();
			break;
		default:
			
			break;
	}
	debug("Type switched to: "+type);
	song_generate();
}

// Play bar - preview play
/**
 * @brief Play bar - preview play
 * @details Play in preview player
 * 
 * @param  bar Id of bar to play.
 */
function bar_play(bar) {
	song_stop();
	debug("bar_play("+bar+")");
	bar_file(bar)
	document.getElementById("player").play();
}

function bar_stop(bar) {

}

function bar_file(bar,player_id) {
	if(player_id == undefined) player_id = "";
	debug("bar_file("+bar+","+player_id+")");
	file = dir+bar+ext;
	var player = document.getElementById("player"+player_id);
	if(player == undefined) {
		alert("ERROR: player not found!");
	}
	//debug("playerAddFile("+id+"):"+file);
	player.innerHTML = "<source src=\""+file+"\" type=\"audio/mpeg\">";
	player.load();
}

/**
 * @brief Iterative play bar of song.
 * @details Play bar of song and plan next bar.
 * 
 * @param bar_i Index of bar song.
 */
function song_play(bar_i) {
	if(bar_i == 0) { // End of song
		song_stop();
		$('#song_stop').prop('disabled', false);
		$('#song_play').prop('disabled', true);
	}
	var bar = document.getElementById("player"+bar_i);
	if(bar == undefined) { // ERROR
		$('#song_stop').prop('disabled', true);
		$('#song_play').prop('disabled', false);
		return;
	}
	// Next bar
	var nid = bar_i + 1;
	bar.play();
	// Remember timming handler
	playing[bar_i] = setTimeout(function() {song_play(nid)},1800);
	$('.playing').removeClass('playing');
	debug(".bar"+bar_i+" .song");
	$(".bar"+bar_i+".song").addClass('playing');
}


function song_stop() {
	debug("song_stop()");
	for(var i = 0; i < playing.length; i ++) {
		debug("song_stop("+i+")");
		clearTimeout(playing[i]);
		var player = document.getElementById("player"+i);
		player.pause();
		player.currentTime = 0.00;
	}
		$('#song_stop').prop('disabled', true);
		$('#song_play').prop('disabled', false);
}

function song_again() {

}

function song_clear() {
	html_get("song").val("");
	song = [];
	$('.song').removeClass('song');
	$('.playing').removeClass('playing');
}

function song_preview() {
	var html_song = html_get("song");
	html_song.val(song.join(","));
}

/**
 * @brief Dice toss
 * @details 
 * 
 * @param  top Top border of the interval
 * @return Random generated number.
 */
function dice_toss(top) {
	// Generate number in the interval <1;top>
	return Math.floor(Math.random() * top);
}

function get_html_bars(id) {
	debug("get_html_bars("+id+")");
	switch(id) {
		case 'M':
			html_bars = html_get("minuets");
		break
		case 'T':
			html_bars = html_get("trios");
		break
		default:
			alert("ERROR: Unknow type of song!");
			throw "Wrong type "+id+" for get_html_bars()";
	}
	return html_bars;
}

/**
 * @brief [brief description]
 * @details [long description]
 * 
 * @param  [description]
 * @return [description]
 */
function get_bars(id) {
	debug("get_bars("+id+")");
	var_exist(minuet);
	var_exist(trio);
	switch(id) {
		case 'M':
			bars = minuet;
		break
		case 'T':
			bars = trio;
		break
		default:
			alert("ERROR: Unknow type of song!");
			throw "Wrong type "+id+" for get_bars()";
	}
	var_exist(bars);
	return bars;
}

function song_generate() {
	debug("song_generate("+type+")");

	bars = get_bars(type);

	var_exist(bars);
	var_exist(song);

	var rows = bars.length;
	var cols = bars[0].length;

	song_clear();

	debug("rows: "+rows+", cols: "+cols);

	for(col = 0; col < cols; col++) {
		row = dice_toss(rows);
		bar = bars[row][col];
		song.push(type+bar);
		html_get(type+bar).addClass('song');
		bar_file(type+bar,col);
	}
	debug(song);
	song_preview();
	$('#song_play').prop('disabled', false);
	preload();
}

function bars_init(id) {
	debug("bars_init("+id+")");
	bars = get_bars(id);
	html_bars = get_html_bars(id);

	var rows = bars.length;
	
	var html = '';
	html += '<table border="1">'
	for(r = 0; r < rows; r++) {
		html += '<tr>';
		for(c = 0; c < bars[r].length; c++) {
			var bar = bars[r][c];
			html += '<td><button class="bar bar'+c+'" id="'+id+bar+'" onclick="bar_play(\''+id+bar+'\')">'+bar+'</button></td>';
		}
		html += '</tr>';
	}
	html += '</table>'
	html_bars.html(html);
}

function player_init(){
	debug("player_init");
	player = html_get("players");
	player.html("");
	for(var i = 0; i< BARS_COUNT; i++) {
		debug("player_init("+i+")");
		// controls
		player.append('<audio id="player'+i+'"	></audio>');
	}
}

function preload() {
	debug("Preload");

	html_get("song_play").html("Loading...");

	loaded = new Array(BARS_COUNT);
	debug("preload: "+loaded);

	for (var i = 0; i< BARS_COUNT; i++) {
		debug("player "+i+" handled!");
		html_get("player"+i).on("loadeddata",function(e){
		//document.getElementById("player"+i).addEventListener("loadeddata", function() {
			onloaded(e);
			//html_get("player"+i).show();
		});
	}
}

function onloaded(e) {
	//console.log(e);
	var id = e.target.id;
	var i = e.target.id.substr(6);
	debug("player "+i+" ("+id+") loaded!");
	loaded[i] = true;
	is_loaded();
}

function is_loaded() {
	for (var i = 0; i< BARS_COUNT; i++) {
		if(!loaded[i]) {
			debug("check player "+i+" not loaded!")
			return false;
		}
	}
	html_get("song_play").html("Play song...");
	//song_play();
}

// *** MAIN ***
bars_init("M");
bars_init("T");
player_init();
type_switch();

$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  

    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
    }

    $(this).find('.btn').toggleClass('btn-default');
	}
);

$("#type").click(function(){
	type_switch();
});