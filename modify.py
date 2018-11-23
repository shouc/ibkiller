import requests
def replaceStar(strs):
	strs = strs.replace("*", "\\times")
		
	return strs


def getPapers():

	for i in range(13,19):
		for j in ['May', 'November']:
			for k in ['1', '2']:
				for l in ['SL', 'HL']:
					get("https://ibrepository.com/IB PAST PAPERS - YEAR/20%s %s/Group 1 - Studies in language and literature/Chinese_A_Literature_paper_%s_%s.pdf"%(i, j, k, l), "%s_%s_%s_%s.pdf"%(i,j,k,l))
					get("https://ibrepository.com/IB PAST PAPERS - YEAR/20%s %s/Studies in language and literature/Chinese_A_Literature_paper_%s__%s.pdf"%(i, j, k, l), "%s_%s_%s_%s.pdf"%(i,j,k,l))

def get(url, fn):
	
	headers = {'cookie': '__cfduid=d69d18cc0f98ccbf3cd65cd735e2c4ac91542070531; _ga=GA1.2.2125634954.1542070581; _gid=GA1.2.236709741.1542070581', 'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'accept-encoding': 'gzip, deflate, br', 'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8'}

	r = requests.get(url, headers=headers)
	print r.status_code
	if r.status_code != 404:
		with open("/Users/shouc/Desktop/Lit/" + fn, 'wb') as fd:
		    for chunk in r.iter_content(20):
		        fd.write(chunk)

getPapers()


