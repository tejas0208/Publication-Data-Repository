import re

sent = "2016 International Conference on Computing, Analytics and Security Trends (CAST) College of Engineering Pune, India. Dec 19-21, 2016"
sent = sent.lower()
smallest = 0

#regex = "international journal (of|on)(.*)(,|vol*|issue)"
regex1 = "international.*journal (of|on)(.*)"
regex2 = "international.*journal (of|on)(.*)(vol)"
regex3 = "international.*journal (of|on)(.*)issue"
x1 = re.search(regex1, sent)
if x1:
    small = len(x1[0])
    smallest = 1
    
x2 = re.search(regex2, sent)
if x2:
    if len(x2[0]) < small:
        small = len(x2[0])
        smallest = 2
    
x3 = re.search(regex3, sent)
if x3:
    if len(x3[0]) < small:
        small = len(x3[0])
        smallest = 3

if smallest == 1:
    x = x1[0][0:len(x1[0])]
elif smallest == 2:
    x = x2[0][0:len(x2[0])-4]
elif smallest == 3:
    x = x3[0][0:len(x3[0])-6]
if smallest != 0:
    print(x)

regex1 = "international.*conference (of|on)(.*)"
regex2 = "international.*conference (of|on)(.*)(vol)"
regex3 = "international.*conference (of|on)(.*)issue"
x1 = re.search(regex1, sent)
if x1:
    small = len(x1[0])
    smallest = 1
    
x2 = re.search(regex2, sent)
if x2:
    if len(x2[0]) < small:
        small = len(x2[0])
        smallest = 2
    
x3 = re.search(regex3, sent)
if x3:
    if len(x3[0]) < small:
        small = len(x3[0])
        smallest = 3

if smallest == 1:
    x = x1[0][0:len(x1[0])]
elif smallest == 2:
    x = x2[0][0:len(x2[0])-4]
elif smallest == 3:
    x = x3[0][0:len(x3[0])-6]
if smallest != 0:
    print(x)

regex = "vol.{0,5}[0-9]{1,2}"
x = re.search(regex, sent)
if x:
    print(x[0])
else:
    regex = "vol.{0,5}M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})"
    x = re.search(regex, sent)
    if x:
        print(x[0])

regex = "issue.{1,2}([0-9]{1,2}|M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3}))"
x = re.search(regex, sent)
if x:
    print(x[0])
else:
    regex = "issue.{1,2}M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})"
    x = re.search(regex, sent)
    if x:
        print(x[0])

regex = "(january|february|march|april|may|june|july|august|september|october|november|december).{1,2}[0-9]{2,4}"
x=re.search(regex, sent)
if x:
    print(x[0])
else:
    regex = "(20..)|(1[5-9])"
    x=re.search(regex, sent)
    if x:
        print(x[0])
