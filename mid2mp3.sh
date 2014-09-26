#!/bin/bash

## Variables - dirs without / at the end
# Source mid
mid_dir="./mid"
mid_ext="MID"
# Non-cutted mp3
mp3l_dir="./mp3l"
mp3l_ext="mp3l"
# mp3 results
mp3l_dir="./mp3"
mp3l_ext="mp3"
# Tim for cutting
start="00.07"
duration="01.83" # in seconds

## Functions
function mid2mp3 {
	if [ $# -ne 1 ]; then
		echo "ERROR: midi2mp3 function without file!"
		exit 1;
	fi
	mid=$1
	mp3l="${mid%.*}.mp3l"
	mp3="${mid%.*}.mp3"
	echo "- $mid -> $mp3l"
	timidity --output-24bit $mid -Ow -o - | lame - -b 64 $mp3l
	ffmpeg -ss $start -t $duration -i $mp3l $mp3
	#
}

function mp3cut {
	if [ $# -ne 1 ]; then
		echo "ERROR: midi2mp3 function without file!"
		exit 1;
	fi
	mp3l=$1
	mp3l="${mid%.*}.mp3l"
	mp3="${mid%.*}.mp3"
	echo "- $mid -> $mp3l"
	timidity --output-24bit $mid -Ow -o - | lame - -b 64 $mp3l
	ffmpeg -ss $start -t $duration -i $mp3l $mp3
	#
}

function all_mid {
	files=( `ls $dir/*.$ext` )
	for file in ${files[@]}; do
		#echo "- converting $file"
		mid2mp3 $file
	done
}

## Main

rm -rf $dir/*.mp3l
rm -rf $dir/*.mp3

all_mid
#midi2mp3 M1.MID
