### Terms
**paper: ** To make users to select the questions they are going to practice much easier, every ten questions (Multiple Choice) or three questions (Short Answer) of same chapter but different type would be put into one paper.    

**question type:** 1 is multiple choice question; 2 is short answer question; 3 is long answer question.

**reference code (定位码): ** An unique code to identify the question. Its form is {question creator}@{question characteristics}@{chapter}@{unique random code}.

### Logic
The App starts with a screen that fills with subjects (i.e. Chemistry). The user could press on one subject and then the App would take them to the category screen. In such screen, the user could select the *paper*. After selected, the App would judge the *question type* and take them to one of the three screens (Multiple choice/Short/Long). As soon as the users finish, the App would bring them towards check screen, where they could see both markschemes and their answers.
### Todos
1. Picture upload module
2. Register Validation

## Freelancers
The system location is http://admin.ibkiller.com:8000/ Please use computer to visit the system.
#### Bulk Validation
Here, freelancers could validate 10 questions in one page. The purpose of creating this page is to help freelancers identify errors in MathJax and HTML.
## Developers
System is based on Laravel, with Auth module enabled, on Centos 7 (Qcloud).
#### Database Structure
| Name  | Type  | Description  |
| :------------: | :------------: | :------------: |
|  question  | TEXT  | the content of the question (HTML)  |
|  chapter  |  VARCHAR 8  |  the chapter of the queston (i.e. 1.1)  |
|  type  |  INT 11  |  *question type*  |
|  mark  |  INT 11  | the mark of the queston (i.e. 1)  |
|  paper  |  TEXT  | the paper of the queston (i.e. Intro 1)  |
|  ref  |  VARCHAR 80  |  *reference code*  |
|  ok_by  |  TEXT  |  the creator and validator of the question  |
#### Controllers
`HomeController@index`
`HomeController@add`
`HomeController@modify`
`HomeController@bulk`
`QuestionController@val`
`QuestionController@add`
`QuestionController@modify`
`QuestionController@stats`
