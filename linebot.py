# file name: linebot.py
# coding:utf-8
 
import sys,urllib2
import json
 
if __name__=='__main__':


	receivetext = sys.argv[1]
	#receivetext = '東京'

	#ここに処理を書く

	if receivetext == 'help':
		print "ここを参考に天気コードを入力してください。"
		print "UPL->http://weather.livedoor.com/forecast/rss/primary_area.xml"
		#ここはできている
	else:
		weatherlist={
			"稚内":"011000",
			"旭川":"012010",
			"留萌":"012020",
			"網走":"013010",
			"北見":"013020",
			"紋別":"013030",
			"根室":"014010",
			"釧路":"014020",
			"帯広":"014030",
			"室蘭":"015010",
			"浦河":"015020",
			"札幌":"016010",
			"岩見沢":"016020",
			"倶知安":"016030",
			"函館":"017010",
			"江差":"017020",
			"青森":"020010",
			"むつ":"020020",
			"八戸":"020030",
			"盛岡":"030010",
			"宮古":"030020",
			"大船渡":"030030",
			"仙台":"040010",
			"白石":"040020",
			"秋田":"050010",
			"横手":"050020",
			"山形":"060010",
			"米沢":"060020",
			"酒田":"060030",
			"新庄":"060040",
			"福島":"070010",
			"小名浜":"070020",
			"若松":"070030",
			"水戸":"080010",
			"土浦":"080020",
			"宇都宮":"090010",
			"太田原":"090020",
			"前橋":"100010",
			"みなかみ":"100020",
			"さいたま":"110010",
			"熊谷":"110020",
			"秩父":"110030",
			"千葉":"120010",
			"銚子":"120020",
			"館山":"120030",
			"東京":"130010",
			"大島":"130020",
			"八丈島":"130030",
			"父島":"130040",
			"横浜":"140010",
			"小田原":"140020"	
		}



		cityname = receivetext

		if cityname in weatherlist:
			citycode = weatherlist[cityname]
			resp = urllib2.urlopen("http://weather.livedoor.com/forecast/webservice/json/v1?city=%s" % citycode).read()
			resp = json.loads(resp)
			print cityname + "の天気予報"
			for forecast in resp['forecasts']:
				print "*************"
				print forecast['dateLabel']+ "(" + forecast['date'] + ")"
				print forecast['telop']
			print "*************"

		else:
			print cityname + 'の天気予報の情報がありませんでした。'

		#sendtext = "*************\n" + resp['title'] + "\n*************\n" + resp['description']['text'] + forecasttext + "\n*************\n"
		#sendtext = resp['description']['text']
