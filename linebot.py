# file name: linebot.py
# coding:utf-8
 
import sys,urllib2
import json
 
if __name__=='__main__':


	receivetext = sys.argv[1]
	#receivetext = '460010'

    #ここに処理を書く

	if receivetext == 'help':
		sendtext = "ここを参考に天気コードを入力してください。UPL->http://weather.livedoor.com/forecast/rss/primary_area.xml"

	else:
		#citycode = sys.argv[1]
		citycode = receivetext
		resp = urllib2.urlopen("http://weather.livedoor.com/forecast/webservice/json/v1?city=%s" % citycode).read()
		resp = json.loads(resp)
		#forecasttext = ''

		#for forecast in resp['forecasts']:
		#	forecasttext = forecasttext + "\n*************\n"
		#	forecasttext = forecasttext + forecast['dateLabel']+ "(" +forecast['date'] + ")\n"
		#	forecasttext = forecasttext + forecast['telop']

		#sendtext = "*************\n" + resp['title'] + "\n*************\n" + resp['description']['text'] + forecasttext + "\n*************\n"
		sendtext = resp['description']['text']
	print sendtext
	#ここでphpに戻している