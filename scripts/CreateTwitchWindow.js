//Save Place before leaving
$(window).bind("beforeunload", function()
{
    saveVodTime();
});

function getCurrentUser()
{
    var div = document.getElementById("userid");
    return div.textContent;
}

//Player embedding
$(function ()
{
	window.onPlayerEvent = function (data)
    {
		data.forEach(function (event)
        {
			//console.log("EVENT: %s", event.event);
			if(event.event == "playerInit")
            {
				var player = $("#twitch_embed_player")[0];
				player.playVideo();
			}
			if(event.event == "videoPlaying" && currVodTime != 0)
			{
				//console.log("Seeking to time: " + currVodTime);
				var player = $("#twitch_embed_player")[0];
				player.videoSeek(currVodTime);
				currVodTime = 0;
			}
		});
	}

	swfobject.embedSWF("http://www-cdn.jtvnw.net/swflibs/TwitchPlayer.swf", "twitch_embed_player", "640", "400", "11", null, {
		"eventsCallback": "onPlayerEvent",
		"embed": 1,
		"channel": "",
		"auto_play": "true"
	}, {
		"allowScriptAccess": "always",
		"allowFullScreen": "true"
	});
});

//Global for current Vod
var currVod = "";
var currVodTime = 0;
function setCurrentVod(vodId)
{
    currVod = vodId;
    saveVodTime();
}

function getCurrentVod()
{
    return currVod;
}

function getCurrentVodTime()
{
	var player = $("#twitch_embed_player")[0];
    return player.getVideoTime();
}

function saveVodTime()
{
    if(getCurrentVod() == "") {return;}

    $.get("http://retwitch.pingdynamic.com/scripts/SaveVodTiming.php?" +
        "userid=" + getCurrentUser() +
        "&vodid=" + getCurrentVod() +
        "&currentTime=" + getCurrentVodTime())
        .success(function(response) {console.log("Saved Vod: " + response);});
}

function seekVod(vodTime)
{
	currVodTime = vodTime;
	console.log("Caching Vod Time: " + vodTime);
}

function loadVod(vodId)
{
    if(getCurrentVod() != "")
    {
        console.log("Saving Vod before loading another");
        saveVodTime();
    }
	
	console.log(vodId);
	
	var player = $("#twitch_embed_player")[0];
    player.loadVideo(vodId);

    //Check for errors after loading Vod
    player.playVideo();
    setCurrentVod(vodId);
}

function getVODUrl() 
{
    //Make sure this is a twitch link
    var vodUrl = document.getElementById("vodUrl").value;
    if (vodUrl.indexOf("twitch.tv") == -1)
    {
        alert("Only Twitch.tv links are supported and they must contain 'twitch.tv': " + vodUrl);
        return;
    }

    //Save Current Vod if one is playing
    if(getCurrentVod() != "")
    {
        console.log("Saving Vod before loading another");
        saveVodTime();
    }

    //Load new Vod
	var pieces = document.getElementById("vodUrl").value.split("/");

    //Fix Twitch prefix.  For whatever reason all vods with a prefix of 'b' are actually stored as 'a'
    var prefix = pieces[pieces.length-2];
    if(pieces[pieces.length-2] == 'b') {prefix = 'a';}

    var player = $("#twitch_embed_player")[0];
    player.loadVideo(prefix + pieces[pieces.length-1]);

    //Check for errors after loading Vod
    player.playVideo();
    setCurrentVod(prefix + pieces[pieces.length-1]);
}