#!/usb/bin/env python3
#-*- coding: utf-8 -*-
import time
import pymysql
import paho.mqtt.client as mqtt
import json
import datetime

#callback : funcion que se invoca cuando el cliente se conecta al Broker
def on_connect(client, userdata, flags, rc):
	#imprime el resultado de la conexion
	print("Conectando al broker: %s >>> con codigo de resultado %s" \
	% (broker,str(rc)))
	# Subscribe al topico MQTT
	client.subscribe(topico)
	print("Suscrito al topico : %s\n" % topico)

#Callback : funcion que recibe mensaje publicados en el topico
def on_message(client, userdate, msg):
	# se recibe el mensaje en "msg"
	auxiliar = (msg.payload.decode("utf-8"))
	#Imprime el mensaje tal como se recibe
	print("Mensaje recibido en el topico")
	#Se intenta decodificar los datos del mensaje JSON
	parsed_data = json.loads(auxiliar)
	# Se extraen los datos decodificados
	temperatura = float(parsed_data['T'])
	# temperatura = int(parsed_data['T'])
	humedad = float(parsed_data['HR'])
	humedadDos = float(parsed_data['HRDOS'])
	if(humedad > 250):
		# humedad = int(parsed_data['HR'])
		hra = float(parsed_data['HRA'])
		# hra = int(parsed_data['HRA'])
		#Se obtiene Fecha y Hora actuales
		str_Date = datetime.datetime.now() .strftime('%Y/%m/%d')
		str_Time = datetime.datetime.now() .strftime('%H:%M:%S')
		#Se le imprimen los datos para el usuario
		print('Fecha y Hora : %s %s' % (str_Date, str_Time))
		print('Temperatura : %f oC' % temperatura)
		print('Humedad del suelo: %f \n' % humedad)
		print('Humedad del suelo 2: %f \n' % humedadDos)
		print('Humedad ambiental: %f \n' % hra)

		#TBname = "TBnodo1"
		TBname = "TBNodo2"
		sql_string = "INSERT INTO %s (T,HR, HRDOS, HRA) VALUES ('%f', '%f', '%f', '%f')" % (TBname,temperatura,humedad, humedadDos, hra)
		try:
			db = pymysql.connect("localhost", "root", "password", "optativa")
			cursor=db.cursor()
			cursor.execute(sql_string)
			db.commit()
			db.close()
			print(sql_string)
			print("Exito: se inserto en la base de datos!\n")
		except pymysql.Error as error:
			print("Error: {}".format(error))
		###################################
	
	
# programa principal
myDebug = True
topico = 'utt0317115032/test'
broker = 'broker.hivemq.com'
# crea la instancia de un cliente MQTT sin ID
client = mqtt.Client()
# crea la funcion Callback de conexion
client.on_connect = on_connect
# se define la funcion callback que recibe mensajes
client.on_message = on_message
# intenta conexion con el Broker, se invoca .on_connect
client.connect(broker,1883,60)
#no es necesario un ciclo perpetuo, lo manejara .loop_forever
client.loop_forever()