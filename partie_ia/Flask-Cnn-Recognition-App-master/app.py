import flask
from flask import Flask,render_template,url_for,request
import pickle
import cv2
from flask import request
import mysql.connector
from fitz import fitz, Rect
import string
import random
from tensorflow import keras 
from keras.models import Sequential
import tensorflow as tf
from keras.models import Sequential
from keras.layers import Conv2D, ZeroPadding2D
from keras.layers import MaxPooling2D
from keras.layers import Flatten
from keras.layers import Dense
from keras.preprocessing.image import ImageDataGenerator
from IPython.display import display
import numpy as np
from pathlib import Path

from keras.preprocessing import image
import tensorflow as tf
from keras.preprocessing import image
import matplotlib.pyplot as plt
import matplotlib.image as mpimg
import matplotlib.pyplot as plt
import matplotlib.image as mpimg
from PIL import Image
import base64
import io
from PIL.ImageQt import ImageQt
import os


import PIL.Image as Image
import base64

init_Base64 = 21;

app = flask.Flask(__name__, template_folder='templates')
#route 1 : page draw
@app.route('/')
def home():
    idutilisateur=request.args.get("idutill", default=0, type=int)
    idpdf=request.args.get("idpdff")
    return render_template('draw.html',idutill =idutilisateur ,idpdff =idpdf)

#route 2 : page results
@app.route('/predict', methods=['POST'])
def predict():
        graph = tf.Graph()
        with graph.as_default():
            if request.method == 'POST':

                    model = tf.keras.models.load_model("offline-sign-CNN-01.h5")
                    draw = request.form['url']
                    #supprimer parties non necessaires de l'url
                    draw = draw[init_Base64:]
                    #Decodage de  l'image
                    draw_decoded = base64.b64decode(draw)
                    image = np.asarray(bytearray(draw_decoded), dtype="uint8")
                    image = cv2.imdecode(image, cv2.IMREAD_COLOR)
                    #Redimensionner et remodeler pour garder le ratio.
                    resized = cv2.resize(image, (220,150), interpolation = cv2.INTER_AREA)
                    vect = np.asarray(resized, dtype="uint8")
                    img = Image.fromarray(vect)
                    img_byte_arr = io.BytesIO()
                    img.save(img_byte_arr, format='PNG')
                    image = tf.keras.preprocessing.image.img_to_array(img)
                    vect = np.expand_dims(image, axis = 0)
                    #calcul prediction
                    result = model.predict(vect)

                    if result[0][0] >= 0.5:
                        pred = 'Genuine'
                        id_util = request.form['idutil']
                        id_pdf = request.form['idpdf']
                        requete = """insert into historique (idutil,id_pdf,signature_valide) values (%s, %s, %s)"""
                        params = (id_util,id_pdf,1)
                        with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as db :
                            with db.cursor() as c:
                                c.execute(requete, params)
                                db.commit()
                    else:
                        id_util = request.form['idutil']
                        id_pdf = request.form['idpdf']
                        pred = 'forged'
                        requete = """insert into historique (idutil,id_pdf,signature_valide) values (%s, %s, %s)"""
                        params = (id_util,id_pdf,0)
                        with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as db :
                            with db.cursor() as c:
                                c.execute(requete, params)
                                db.commit()

        return render_template('results.html', prediction =pred, i=img ,idutil=id_util,idpdf=id_pdf ,dat=request.form['url'])


@app.route('/verif', methods=['POST'])
def verif():
        #recuperer les donnees 
        if request.method == 'POST':
            code_sec= request.form['x']
            id_util= request.form['y']
            id_pdf= request.form['z']
            #calculer nombre des signatures deja trouves dans le pdf
            param_1= (id_pdf,1,1,)   
            requete_1 = """select * from historique where id_pdf=%s and  signature_ajoutee=%s and signature_valide=%s """
            with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as db_1 :
                with db_1.cursor(buffered=True) as cur_1:
                    cur_1.execute(requete_1,param_1)
                    nombreligne=cur_1.rowcount

            #recherche nom pdf
            par = (id_pdf,)   
            requete_4 = """select nom_pdf from upload where idd=%s"""
            with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as db_3 :
                with db_3.cursor() as cur_3:
                    cur_3.execute(requete_4,par)
                    resultat = cur_3.fetchall()
            for i in resultat:            
               nom_pdf=str(i[0])
            #recherche code securite de l'utilisateur
            requete_2= "select code , nom,prenom from utilisateur where id = %s"
            params = (id_util,)
            with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as db :
                with db.cursor() as cur_4:
                    cur_4.execute(requete_2, params)
                    resultats = cur_4.fetchall()

            for utilisateur in resultats:            
                if (utilisateur[0]==int(code_sec)):
                    #ouverture de pdf
                        doc = fitz.open(" "+nom_pdf)
                        draw = request.form['j']
                    #supprimer les parties non necessaires de l'url
                        draw = draw[init_Base64:]
                        #decodage de l'image
                        b=base64.b64decode(draw)
                        img=io.BytesIO(b)
                        pdf=doc
                        #calcul position de la nouvelle signature 
                        if nombreligne==0 :
                            w = 570
                            h=810
                            x1 = 0.945
                            x2 = 0.96
                            rect = fitz.Rect(w * x1 * 0.94, h * x2, w, h)
                        elif nombreligne==1 :
                            w = 500
                            h=810
                            x1 = 0.92
                            x2 = 0.96
                            rect = fitz.Rect(w * x1 * 0.94, h * x2, w, h)       
                        else :
                            w = 430
                            h=810
                            x1 = 0.9
                            x2 = 0.96
                            rect = fitz.Rect(w * x1 * 0.94, h * x2, w, h)     
                        #ajout de la nouvelle signature dans la 1ere page
                        for i in range(0, 1):
                            page = pdf[i]
                            if not page.is_wrapped:
                                page.wrap_contents()
                            page.insert_image(rect,stream=img)
                            page.insert_textbox(rect,"Signed by "+utilisateur[1]+" "+utilisateur[2], fontsize=5, fontname='helv')
                        doc.saveIncr() 
                        #fermer fichier pdf
                        doc.close()
                        #ajouter l'historique
                        requete_5 = """update historique set signature_ajoutee=%s where id_pdf=%s and idutil=%s"""
                        parametres = (1,id_pdf,id_util)
                        with mysql.connector.connect(host="localhost",user="root",password="",database="signature") as d :

                            with d.cursor() as c:
                                c.execute(requete_5, parametres)
                                d.commit()

                        return render_template('verif.html')

                else:
                    return render_template('erreur.html')




if __name__ == '__main__':
	app.run(host='localhost', port=8000, debug=True)
    
