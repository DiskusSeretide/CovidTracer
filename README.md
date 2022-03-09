# Population traffic data for control COVID-19 dispersion

## The aim of this work is to develop a population data system, which attendance of points of interest and management of possible contact with a COVID-19 case
Managing the pandemic by COVID-19 and its aftermath is a challenge in many countries of the world. Multipliers can be used to control possible dispersal
Traffic data already collected by providers such as Google and related to frequency of visits to geographical points of interest (POIs), such as shops, restaurants,
services during the day and week (popular times). The traffic density can act as an indicator of a place's popularity, but also as risk factor for possible spread of COVID-19. 
At the same time, it is only an estimate based on geographical location data and does not depend on the actual number of visitors to a site. It would therefore be useful to enable a visitor to contribute his or her own estimate of the actual number of visitors. By retaining the visit information anonymously, it can be combined with a possible case entry, so that other users are informed if they were in the same area with a reported case. Thus, the purpose of this work is to build a system of mass collection of traffic data and possible case reporting in order to provide traffic information to points of interest, but also to inform about possible contact with a reported case, as a means of controlling the spread.

# There are two types of users
## User
### The interaction with the user is done through an adaptive website that allows access via desktop or mobile phone, and has the following capabilities:
1) Registration in the system. The user registers and accesses the system by selecting a username & password of his choice, and providing his email. The password is
   required be at least 8 characters and contain at least one capital letter, a number and a symbol (e.g. # $ * & @).
2) The user is shown a map focusing on the geographical location at the time of access.
3) Search for points of interest. The results of this search are displayed as markers. Clicking on a marker shows information about traffic and an index of COVID-19 spread risk.
4) Registration of a POI visit and crowd estimation.
5) The user has the ability to state in the application if he is COVID-19 case and when it was diagnosed.
6) The user can see if he has come in contact with a case of last 7 days. A list of points of interest visited by the user is displayed, including date and time,
   and for which a case has been recorded which:  
   &nbsp;&nbsp;&nbsp;a) Was at the same point as the user in a range of +- 2 hours and  
   &nbsp;&nbsp;&nbsp;b) has been diagnosed as a case within 7 days of the visit.
7) The user can edit his personal info and see the detailed history of his visits and case statements he/she has made.

## Administrator
### The administrator is not registered in the system but is created as an entity directly to the relevant database. When logging in, it has the following features:
1) The administrator has the ability to load POIs and traffic data. Administrator can also update, validate and choose to delete this data.
2) The administrator page is used as a relevant information tracking media depicting via raw numbers, tables or graphs:  
   &nbsp;&nbsp;&nbsp;a. Total number of visits recorded  
   &nbsp;&nbsp;&nbsp;b. Total number of reported cases    
   &nbsp;&nbsp;&nbsp;c. Total number of visits from active cases (7 days before the case diagnosis date and up to 14 days after)   
   &nbsp;&nbsp;&nbsp;d. Classification of the categories of points of interest, based on the total number of visits as recorded by users  
   &nbsp;&nbsp;&nbsp;e. Classification of the categories of points of interest, based on the number of cases that had occurred  
   &nbsp;&nbsp;&nbsp;f. Chart by day, where:  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i. A predefined range is selected (specific week or specific month)  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii. The possibility of displaying one or more of them is selected with a filter below:  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. The number of visits reported by users for each day    
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. The number of visits from diagnosed cases for each day  
   &nbsp;&nbsp;&nbsp;g. Chart by hour, where:  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i. A specific date is selected  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ii. The ability to display one or more of the following is selected with a filter:  
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. The change in the number of visits per hour    
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. The change in the number of visits from a reported case per hour  
