import pandas as pd
import mysql.connector
from datetime import date

# função para calcular a idade dos candidatos
def calcular_idade(data_nascimento):
    hoje = date.today()
    idade = hoje.year - data_nascimento.year - ((hoje.month, hoje.day) < (data_nascimento.month, data_nascimento.day))
    return idade

def conexão():
    # conexão com o sisep
    cnx = mysql.connector.connect(user='root', password='', host='localhost', database='sisep_bd')
    cursor = cnx.cursor() 

    # buscas no bd
    query_dados_pessoais = "SELECT n_inscricao, nome, data_nascimento, curso_desejado FROM dados_pessoais"
    query_nota_sexto = "SELECT n_inscricao, nota_portugues_sexto, nota_matematica_sexto, nota_historia_sexto, nota_geografia_sexto, nota_ciencias_sexto, nota_artes_sexto, nota_religioso_sexto, nota_ingles_sexto, nota_ed_fisica_sexto, nota_ingles_sexto FROM sexto_ano"
    query_nota_setimo = "SELECT n_inscricao, nota_portugues_setimo, nota_matematica_setimo, nota_historia_setimo, nota_geografia_setimo, nota_ciencias_setimo, nota_artes_setimo, nota_religioso_setimo, nota_ingles_setimo, nota_ed_fisica_setimo, nota_ingles_setimo FROM setimo_ano"
    query_nota_oitavo = "SELECT n_inscricao, nota_portugues_oitavo, nota_matematica_oitavo, nota_historia_oitavo, nota_geografia_oitavo, nota_ciencias_oitavo, nota_artes_oitavo, nota_religioso_oitavo, nota_ingles_oitavo, nota_ed_fisica_oitavo, nota_ingles_oitavo FROM oitavo_ano"
    query_nota_nono = "SELECT n_inscricao, nota_portugues_nono, nota_matematica_nono, nota_historia_nono, nota_geografia_nono, nota_ciencias_nono, nota_artes_nono, nota_religioso_nono, nota_ingles_nono, nota_ed_fisica_nono, nota_ingles_nono FROM nono_ano"
    query_cotas = "SELECT n_inscricao, deficiente, escola_privada, localidade FROM cotas"

    # executando as buscas...
    cursor.execute(query_dados_pessoais)
    dados_pessoais = {}
    for (n_inscricao, nome, data_nascimento, curso_desejado) in cursor:
        dados_pessoais[n_inscricao] = {'nome': nome, 'data_nascimento': data_nascimento, 'curso_desejado': curso_desejado}

    cursor.execute(query_nota_sexto)
    notas_6 = {}
    for (n_inscricao, *notas) in cursor:
        notas_6[n_inscricao] = notas

    cursor.execute(query_nota_setimo)
    notas_7 = {}
    for (n_inscricao, *notas) in cursor:
        notas_7[n_inscricao] = notas

    cursor.execute(query_nota_oitavo)
    notas_8 = {}
    for (n_inscricao, *notas) in cursor:
        notas_8[n_inscricao] = notas

    cursor.execute(query_nota_nono)
    notas_9 = {}
    for (n_inscricao, *notas) in cursor:
        notas_9[n_inscricao] = notas

    cursor.execute(query_cotas)
    cotas_curso = {}
    for (n_inscricao, deficiente, escola_privada, localidade) in cursor:
        cotas_curso[n_inscricao] = {'deficiente': deficiente, 'escola_privada': escola_privada, 'localidade': localidade}

    cursor.close()
    cnx.close()

    # calculando a idade do povo
    idades = {n_inscricao: calcular_idade(dados['data_nascimento']) for n_inscricao, dados in dados_pessoais.items()}

    return notas_6, notas_7, notas_8, notas_9, dados_pessoais, cotas_curso, idades

# função pra calcular a média geral
def calcular_media_geral(notas_6, notas_7, notas_8, notas_9):
    media_geral = {}
    for n_inscricao in notas_6.keys() | notas_7.keys() | notas_8.keys() | notas_9.keys():
        media_6 = notas_6.get(n_inscricao, [0]*9)  # multiplica por 18, para pegar as 9 notas básicas
        media_7 = notas_7.get(n_inscricao, [0]*9)
        media_8 = notas_8.get(n_inscricao, [0]*9)
        media_9 = notas_9.get(n_inscricao, [0]*9)
        notas_totais = [sum(n) for n in zip(media_6, media_7, media_8, media_9)]  # Somando todas as notas por índice
        num_notas_totais = len([n for n in notas_totais if n != 0])  # Contando o número total de notas diferentes de zero
        media_geral[n_inscricao] = sum(notas_totais) / num_notas_totais if num_notas_totais != 0 else 0  # Calculando a média apenas se houver notas diferentes de zero
    return media_geral

# função pra calcular a média de português
def calcular_media_portugues(notas_6, notas_7, notas_8, notas_9):
    media_geral_portugues = {}
    for n_inscricao in notas_6.keys() | notas_7.keys() | notas_8.keys() | notas_9.keys():
        media_portugues_6 = notas_6.get(n_inscricao, [0])[0]  #esse get(n_inscricao, [0])[0] pega especificamente a nota de português
        media_portugues_7 = notas_7.get(n_inscricao, [0])[0]
        media_portugues_8 = notas_8.get(n_inscricao, [0])[0]
        media_portugues_9 = notas_9.get(n_inscricao, [0])[0]
        media_geral_portugues[n_inscricao] = (media_portugues_6 + media_portugues_7 + media_portugues_8 + media_portugues_9) / 4
    return media_geral_portugues

# matemática
def calcular_media_matematica(notas_6, notas_7, notas_8, notas_9):
    media_geral_matematica = {}
    for n_inscricao in notas_6.keys() | notas_7.keys() | notas_8.keys() | notas_9.keys():
        media_matematica_6 = notas_6.get(n_inscricao, [0])[1]  # esse get(n_inscricao, [0])[1] pega a nota de matemática
        media_matematica_7 = notas_7.get(n_inscricao, [0])[1]
        media_matematica_8 = notas_8.get(n_inscricao, [0])[1]
        media_matematica_9 = notas_9.get(n_inscricao, [0])[1]
        media_geral_matematica[n_inscricao] = (media_matematica_6 + media_matematica_7 + media_matematica_8 + media_matematica_9) / 4
    return media_geral_matematica

# ordenando candidatos e retornando classificados por curso
def imprimir_resultados(media_geral, media_portugues, media_matematica, dados_pessoais, cotas_curso, idades):
    resultados_por_curso = {}
    for n_inscricao in media_geral.keys():
        curso_desejado = dados_pessoais[n_inscricao]['curso_desejado']
        if curso_desejado not in resultados_por_curso:
            resultados_por_curso[curso_desejado] = []
        resultados_por_curso[curso_desejado].append({
            'n_inscricao': n_inscricao,
            'nome': dados_pessoais[n_inscricao]['nome'],
            'media_geral': media_geral[n_inscricao],
            'media_portugues': media_portugues[n_inscricao],
            'media_matematica': media_matematica[n_inscricao],
            'idade': idades[n_inscricao],
            'deficiente': cotas_curso[n_inscricao]['deficiente'],
            'escola_privada': cotas_curso[n_inscricao]['escola_privada'],
            'localidade': cotas_curso[n_inscricao]['localidade']
        })

    classificados_por_curso = {}
    for curso_desejado, candidatos in resultados_por_curso.items():
        candidatos.sort(key=lambda x: (x['media_geral'], x['media_portugues'], x['media_matematica'], x['idade']), reverse=True)
        classificados_por_curso[curso_desejado] = candidatos

    # classificados e classificaveis
    situacao = []
    for curso_desejado, candidatos in classificados_por_curso.items():
        num_classificados = min(len(candidatos), 45)
        for i, candidato in enumerate(candidatos):
            if i < num_classificados:
                situacao.append('Classificado')
            else:
                situacao.append('Classificável')

    # impressão dos resultados
    for curso_desejado, candidatos in classificados_por_curso.items():
        print(f"Curso: {curso_desejado}")
        df = pd.DataFrame(candidatos)
        df['media_geral'] = df['media_geral'].apply(lambda x: f"{x:.2f}".replace('.', ','))
        df['situação'] = situacao[:len(df)]
        situacao = situacao[len(df):]  # removendo as situações já atribuídas
        df = df[['n_inscricao', 'nome', 'media_geral', 'situação']]  # exibindo apenas as colunas desejadas
        print(df)
        print()

# executando o código
notas_6, notas_7, notas_8, notas_9, dados_pessoais, cotas_curso, idades = conexão()
media_geral = calcular_media_geral(notas_6, notas_7, notas_8, notas_9)
media_portugues = calcular_media_portugues(notas_6, notas_7, notas_8, notas_9)
media_matematica = calcular_media_matematica(notas_6, notas_7, notas_8, notas_9)
imprimir_resultados(media_geral, media_portugues, media_matematica, dados_pessoais, cotas_curso, idades)