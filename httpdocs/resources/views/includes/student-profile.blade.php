<div class="container-fluid bg-primary-color course-highlight">
    <div class="row">
        <div class="container">
            <div class="col-md-7">
                <p class="course-title-big">Settings</p>            
            </div>            
        </div>
    </div>
</div>
<div class="container-fluid cbc profileTemp">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </div>
    <div class="row">
    
      <div class="col-md-3">
       
          <div class="subCategoriesBlk studentProfile">
            <h2>User Information</h2>
            <ul>
              <li><a href="tsProfileBox">Basic Information</a>
              <span>Please verify and confirm your basic user information. Thank you!</span>
              </li>
            
              <li><a href="tsAddressBox">Address</a><span>Please confirm your communication address. Thank you!</span></li>
              <li><a href="tsEducationBox">Education Information</a><span>Providing your education information will enable us to serve you even better. Thank you!</span></li>
              <li><a href="tsWorkExpBox">Work Information</a><span>Your Work experience will highlight your profile. Thank you!</span></li>
                 <li><a href="tsResetPassword">User Password</a>
              <span>Please Reset your new password. Thank you!</span>
              </li>
            </ul>
            
             <h2>User Role</h2>
            <ul>
              <li><a href="tsStudent">Type</a>
              	<span>Please update your name in student block!</span>
              </li>
              <li><a href="tsUI">User Identity Information</a>
              <span>These information will help us to avail you with any government benefits!</span>
              </li>
            </ul>
            
            <h2>Enrollments</h2>
            <ul>
              <li><a href="tsSubscriptions">Subscriptions</a>
              	<span>Please find your list of all your Enrolments till date through Takshashilaonline.com</span>
              </li>
              <li><a href="tsBilling">Billing</a>
              <span>Please provide your payment method to have an active subscription with us.</span>
              </li>
            </ul>
          </div>
        
      </div>
      <div class="col-md-8">
        <div class="takshaInfo">
       
          
          	<ul class="tsFormList">
            	<li class="tsProfileBox profileList">
                   <form action="" method="" >
                 <h3>Profile</h3>
            
             <div class="col-md-6">
             
              <div class="fields">
                <label for="fName" class="hide">First Name*</label>
                <input type="text" placeholder="First Name" value="" id="fName" name="fName"  readonly />
              </div>
             
             </div>
             
              <div class="col-md-6">
              
               <div class="fields">
                <label for="lName" class="hide">Last Name*</label>
                <input type="text" placeholder="Last Name" value="" id="lName" name="lName" readonly />
              </div>
              
              
             </div>
             
               <div class="col-md-12">
               
               <div class="fields radioRow">
              
                <label for="tsMale">Male
                <input type="radio" name="tsGender" id="tsMale" value="" />
                </label>
                
                <label for="tsFemale">Female
                <input type="radio" name="tsGender" id="tsFemale" value="" />
                </label>
                
              </div>
               
               </div>
             
            <div class="col-md-12">
            
            
            

             <div class="fields">
             
                <label for="tsEmail" class="hide">Email*</label>
               
               
             
                <div class="col-md-6 no-padding">
                    <input type="text" placeholder="Email" value="" id="tsEmail" name="tsEmail" readonly />               
                </div>
                <div class="col-md-3 smlTxt11">                  
                    <span class="glyphicon glyphicon-warning-sign text-success"></span><span>Verified</span>                
                </div>
                
                <div class="col-md-3 smlTxt11">    
                    <label for="tsNewsLetter" class="newsLetterLabel">
                    <input type="checkbox" name="tsNewsLetter" id="tsNewsLetter" value="" /> <span class="newsLetterTxt">Recieve Taskhashilaonline Newsletter</span>
                    </label>               
                </div>
             
             
              </div>  

           
                 
            </div>
            
            <div class="col-md-12">
            
             <div class="fields">
             
                <label for="fName" class="hide">Mobile*</label>
                  <div class="col-md-6 no-padding">
               		 <input type="text" placeholder="Mobile" value="" id="fName" name="fName"  />
               
             	</div>
                  <div class="col-md-6  smlTxt11">
                  
                   <span>Not Verified <a href="#" style="text-decoration:underline;">Click here for Verification</a></span>
                  
                  </div>
                  
              </div>

			</div>
            
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="fields">
                            <label for="tsEmail" class="hide">Location*</label>
                            <input type="text" placeholder="Location" value="" id="tsLocation" name="tsLocation"  />
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="col-md-6">
                <div class="fields">
                    <label for="tsEmail" class="hide">Pincode*</label>
                    <input type="text" placeholder="Pincode" value="" id="tsLocation" name="tsLocation"  />
                </div>   
            </div>
            
           
                
        <div class="col-md-12">
            <div class="fields submitFields">
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
            </div>
        </div>      
            
            </form>
                
                </li>
                
               
                
                <li class="tsAddressBox profileList">
                
                      <form action="" method="" >
                   
                <h3>Address</h3>
            <div class="col-md-12">            
              <div class="fields">
                <label for="tsAddress1" class="hide">Address 1*</label>
                <input type="text" placeholder="Building Name/Apt.No, Street Name (Address1)" value="" id="tsAddress1" name="tsAddress1"  />
              </div>            
            </div>           
            <div class="col-md-12">           
               <div class="fields">
                <label for="tsAddress1" class="hide">Address 2*</label>
                <input type="text" placeholder="Location/Blvd, Area (Address2)" value="" id="tsAddress2" name="tsAddress2"  />
              </div>            
            </div>
            
            <div class="col-md-12">
              <div class="fields">
                <label class="hide">State*</label>
                <select class="dropdown" name="tsState">
                  <option value="0">State</option>
                  <option value="1">Karnataka</option>
                  <option value="2">Andhra Pradesh</option>
                  <option value="3">Tamil Nadu</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="fields">
                <label class="hide">District*</label>
                <select class="dropdown" name="tsState">
                  <option value="0">District</option>
                  <option value="1">District 1</option>
                  <option value="2">District 2</option>
                  <option value="3">District 3</option>
                </select>
              </div>
            </div>  
                     
            <div class="col-md-12">
                <div class="fields">
                    <label for="tsEmail" class="hide">Pincode*</label>
                    <input type="text" placeholder="Pincode" value="" id="tsLocation" name="tsLocation"  />
                </div>
            </div>
            
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
              </div>
            </div>
            
            </form>
                
                </li>
                
                <li class="tsEducationBox profileList">
                
                   <form action="" method="" >
                  <h3>Education Information</h3>
            
            <div class="col-md-12">
            	<div class="row">
                
                <!--block 1-->
                 <div class="col-md-3">
             
            <div class="fields">
                <label class="hide">Basic/Graduation*</label>
                <select class="dropdown" id="degreeId">
                    <option value="-1">Degree</option>    
                    <option value="1">Not Pursuing Graduation</option>    
                    <option value="2">B.A</option>    
                    <option value="3">B.Arch</option>    
                    <option value="4">BCA</option>    
                    <option value="5">B.B.A</option>    
                    <option value="6">B.Com</option>    
                    <option value="7">B.Ed</option>    
                    <option value="8">BDS</option>    
                    <option value="9">BHM</option>    
                    <option value="10">B.Pharma</option>    
                    <option value="11">B.Sc</option>    
                    <option value="12">B.Tech/B.E.</option>    
                    <option value="13">LLB</option>    
                    <option value="14">MBBS</option>    
                    <option value="15">Diploma</option>    
                    <option value="16">BVSC</option>    
                    <option value="9999">Other</option>  
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label for="insName" class="hide">Institute Name*</label>
                             <input type="text" placeholder="Institute Name" value="" id="insName" name="insName"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              
              	<div class="fields">
                	<label for="yearOfCompletion" class="hide">Year*</label>
                    
                    <select class="dropdown" id="yearOfCompletion">                                  <option value="-1">Year of passing</option>   <option value="2020">2020</option>   <option value="2019">2019</option>   <option value="2018">2018</option>   <option value="2017">2017</option>   <option value="2016">2016</option>   <option value="2015">2015</option>   <option value="2014">2014</option>   <option value="2013">2013</option>   <option value="2012">2012</option>   <option value="2011">2011</option>   <option value="2010">2010</option>   <option value="2009">2009</option>   <option value="2008">2008</option>   <option value="2007">2007</option>   <option value="2006">2006</option>   <option value="2005">2005</option>   <option value="2004">2004</option>   <option value="2003">2003</option>   <option value="2002">2002</option>   <option value="2001">2001</option>   <option value="2000">2000</option>   <option value="1999">1999</option>   <option value="1998">1998</option>   <option value="1997">1997</option>   <option value="1996">1996</option>   <option value="1995">1995</option>   <option value="1994">1994</option>   <option value="1993">1993</option>   <option value="1992">1992</option>   <option value="1991">1991</option>   <option value="1990">1990</option>   <option value="1989">1989</option>   <option value="1988">1988</option>   <option value="1987">1987</option>   <option value="1986">1986</option>   <option value="1985">1985</option>   <option value="1984">1984</option>   <option value="1983">1983</option>   <option value="1982">1982</option>   <option value="1981">1981</option>   <option value="1980">1980</option>   <option value="1979">1979</option>   <option value="1978">1978</option>   <option value="1977">1977</option>   <option value="1976">1976</option>   <option value="1975">1975</option>   <option value="1974">1974</option>   <option value="1973">1973</option>   <option value="1972">1972</option>   <option value="1971">1971</option>   <option value="1970">1970</option>   <option value="1969">1969</option>   <option value="1968">1968</option>   <option value="1967">1967</option>   <option value="1966">1966</option>   <option value="1965">1965</option>   <option value="1964">1964</option>   <option value="1963">1963</option>   <option value="1962">1962</option>   <option value="1961">1961</option>   <option value="1960">1960</option>   <option value="1959">1959</option>   <option value="1958">1958</option>   <option value="1957">1957</option>   <option value="1956">1956</option>   <option value="1955">1955</option>   <option value="1954">1954</option>   <option value="1953">1953</option>   <option value="1952">1952</option>   <option value="1951">1951</option>   <option value="1950">1950</option>   <option value="1949">1949</option>   <option value="1948">1948</option>   <option value="1947">1947</option>   <option value="1946">1946</option>   <option value="1945">1945</option>   <option value="1944">1944</option>   <option value="1943">1943</option>   <option value="1942">1942</option>   <option value="1941">1941</option>   <option value="1940">1940</option>                                      </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label for="gradeId" class="hide">Grade</label>
                    
                    <select class="dropdown" id="gradeId"> 
                    	
                        <option value="0">Grade</option>
                    	<option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        
                     </select>
                    
                </div>
              
              </div>
                <!--block 1-->
                
                 <!--block 2-->
                 <div class="col-md-3">
             
            <div class="fields">
                <label class="hide">Basic/Graduation*</label>
                <select class="dropdown" id="degreeId">
                    <option value="-1">Degree</option>    
                    <option value="1">Not Pursuing Graduation</option>    
                    <option value="2">B.A</option>    
                    <option value="3">B.Arch</option>    
                    <option value="4">BCA</option>    
                    <option value="5">B.B.A</option>    
                    <option value="6">B.Com</option>    
                    <option value="7">B.Ed</option>    
                    <option value="8">BDS</option>    
                    <option value="9">BHM</option>    
                    <option value="10">B.Pharma</option>    
                    <option value="11">B.Sc</option>    
                    <option value="12">B.Tech/B.E.</option>    
                    <option value="13">LLB</option>    
                    <option value="14">MBBS</option>    
                    <option value="15">Diploma</option>    
                    <option value="16">BVSC</option>    
                    <option value="9999">Other</option>  
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label for="insName" class="hide">Institute Name*</label>
                             <input type="text" placeholder="Institute Name" value="" id="insName" name="insName"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              
              	<div class="fields">
                	<label for="yearOfCompletion" class="hide">Year*</label>
                    
                    <select class="dropdown" id="yearOfCompletion">                                  <option value="-1">Year of passing</option>   <option value="2020">2020</option>   <option value="2019">2019</option>   <option value="2018">2018</option>   <option value="2017">2017</option>   <option value="2016">2016</option>   <option value="2015">2015</option>   <option value="2014">2014</option>   <option value="2013">2013</option>   <option value="2012">2012</option>   <option value="2011">2011</option>   <option value="2010">2010</option>   <option value="2009">2009</option>   <option value="2008">2008</option>   <option value="2007">2007</option>   <option value="2006">2006</option>   <option value="2005">2005</option>   <option value="2004">2004</option>   <option value="2003">2003</option>   <option value="2002">2002</option>   <option value="2001">2001</option>   <option value="2000">2000</option>   <option value="1999">1999</option>   <option value="1998">1998</option>   <option value="1997">1997</option>   <option value="1996">1996</option>   <option value="1995">1995</option>   <option value="1994">1994</option>   <option value="1993">1993</option>   <option value="1992">1992</option>   <option value="1991">1991</option>   <option value="1990">1990</option>   <option value="1989">1989</option>   <option value="1988">1988</option>   <option value="1987">1987</option>   <option value="1986">1986</option>   <option value="1985">1985</option>   <option value="1984">1984</option>   <option value="1983">1983</option>   <option value="1982">1982</option>   <option value="1981">1981</option>   <option value="1980">1980</option>   <option value="1979">1979</option>   <option value="1978">1978</option>   <option value="1977">1977</option>   <option value="1976">1976</option>   <option value="1975">1975</option>   <option value="1974">1974</option>   <option value="1973">1973</option>   <option value="1972">1972</option>   <option value="1971">1971</option>   <option value="1970">1970</option>   <option value="1969">1969</option>   <option value="1968">1968</option>   <option value="1967">1967</option>   <option value="1966">1966</option>   <option value="1965">1965</option>   <option value="1964">1964</option>   <option value="1963">1963</option>   <option value="1962">1962</option>   <option value="1961">1961</option>   <option value="1960">1960</option>   <option value="1959">1959</option>   <option value="1958">1958</option>   <option value="1957">1957</option>   <option value="1956">1956</option>   <option value="1955">1955</option>   <option value="1954">1954</option>   <option value="1953">1953</option>   <option value="1952">1952</option>   <option value="1951">1951</option>   <option value="1950">1950</option>   <option value="1949">1949</option>   <option value="1948">1948</option>   <option value="1947">1947</option>   <option value="1946">1946</option>   <option value="1945">1945</option>   <option value="1944">1944</option>   <option value="1943">1943</option>   <option value="1942">1942</option>   <option value="1941">1941</option>   <option value="1940">1940</option>                                      </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label for="gradeId" class="hide">Grade</label>
                    
                    <select class="dropdown" id="gradeId"> 
                    	
                        <option value="0">Grade</option>
                    	<option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        
                     </select>
                    
                </div>
              
              </div>
                <!--block 2-->
                
                
                 <!--block 3-->
                 <div class="col-md-3">
             
            <div class="fields">
                <label class="hide">Basic/Graduation*</label>
                <select class="dropdown" id="degreeId">
                    <option value="-1">Degree</option>    
                    <option value="1">Not Pursuing Graduation</option>    
                    <option value="2">B.A</option>    
                    <option value="3">B.Arch</option>    
                    <option value="4">BCA</option>    
                    <option value="5">B.B.A</option>    
                    <option value="6">B.Com</option>    
                    <option value="7">B.Ed</option>    
                    <option value="8">BDS</option>    
                    <option value="9">BHM</option>    
                    <option value="10">B.Pharma</option>    
                    <option value="11">B.Sc</option>    
                    <option value="12">B.Tech/B.E.</option>    
                    <option value="13">LLB</option>    
                    <option value="14">MBBS</option>    
                    <option value="15">Diploma</option>    
                    <option value="16">BVSC</option>    
                    <option value="9999">Other</option>  
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label for="insName" class="hide">Institute Name*</label>
                             <input type="text" placeholder="Institute Name" value="" id="insName" name="insName"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              
              	<div class="fields">
                	<label for="yearOfCompletion" class="hide">Year*</label>
                    
                    <select class="dropdown" id="yearOfCompletion">                                  <option value="-1">Year of passing</option>   <option value="2020">2020</option>   <option value="2019">2019</option>   <option value="2018">2018</option>   <option value="2017">2017</option>   <option value="2016">2016</option>   <option value="2015">2015</option>   <option value="2014">2014</option>   <option value="2013">2013</option>   <option value="2012">2012</option>   <option value="2011">2011</option>   <option value="2010">2010</option>   <option value="2009">2009</option>   <option value="2008">2008</option>   <option value="2007">2007</option>   <option value="2006">2006</option>   <option value="2005">2005</option>   <option value="2004">2004</option>   <option value="2003">2003</option>   <option value="2002">2002</option>   <option value="2001">2001</option>   <option value="2000">2000</option>   <option value="1999">1999</option>   <option value="1998">1998</option>   <option value="1997">1997</option>   <option value="1996">1996</option>   <option value="1995">1995</option>   <option value="1994">1994</option>   <option value="1993">1993</option>   <option value="1992">1992</option>   <option value="1991">1991</option>   <option value="1990">1990</option>   <option value="1989">1989</option>   <option value="1988">1988</option>   <option value="1987">1987</option>   <option value="1986">1986</option>   <option value="1985">1985</option>   <option value="1984">1984</option>   <option value="1983">1983</option>   <option value="1982">1982</option>   <option value="1981">1981</option>   <option value="1980">1980</option>   <option value="1979">1979</option>   <option value="1978">1978</option>   <option value="1977">1977</option>   <option value="1976">1976</option>   <option value="1975">1975</option>   <option value="1974">1974</option>   <option value="1973">1973</option>   <option value="1972">1972</option>   <option value="1971">1971</option>   <option value="1970">1970</option>   <option value="1969">1969</option>   <option value="1968">1968</option>   <option value="1967">1967</option>   <option value="1966">1966</option>   <option value="1965">1965</option>   <option value="1964">1964</option>   <option value="1963">1963</option>   <option value="1962">1962</option>   <option value="1961">1961</option>   <option value="1960">1960</option>   <option value="1959">1959</option>   <option value="1958">1958</option>   <option value="1957">1957</option>   <option value="1956">1956</option>   <option value="1955">1955</option>   <option value="1954">1954</option>   <option value="1953">1953</option>   <option value="1952">1952</option>   <option value="1951">1951</option>   <option value="1950">1950</option>   <option value="1949">1949</option>   <option value="1948">1948</option>   <option value="1947">1947</option>   <option value="1946">1946</option>   <option value="1945">1945</option>   <option value="1944">1944</option>   <option value="1943">1943</option>   <option value="1942">1942</option>   <option value="1941">1941</option>   <option value="1940">1940</option>                                      </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label for="gradeId" class="hide">Grade</label>
                    
                    <select class="dropdown" id="gradeId"> 
                    	
                        <option value="0">Grade</option>
                    	<option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        
                     </select>
                    
                </div>
              
              </div>
                <!--block 3-->
                
                
                 <!--block 4-->
                 <div class="col-md-3">
             
            <div class="fields">
                <label class="hide">Basic/Graduation*</label>
                <select class="dropdown" id="degreeId">
                    <option value="-1">Degree</option>    
                    <option value="1">Not Pursuing Graduation</option>    
                    <option value="2">B.A</option>    
                    <option value="3">B.Arch</option>    
                    <option value="4">BCA</option>    
                    <option value="5">B.B.A</option>    
                    <option value="6">B.Com</option>    
                    <option value="7">B.Ed</option>    
                    <option value="8">BDS</option>    
                    <option value="9">BHM</option>    
                    <option value="10">B.Pharma</option>    
                    <option value="11">B.Sc</option>    
                    <option value="12">B.Tech/B.E.</option>    
                    <option value="13">LLB</option>    
                    <option value="14">MBBS</option>    
                    <option value="15">Diploma</option>    
                    <option value="16">BVSC</option>    
                    <option value="9999">Other</option>  
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label for="insName" class="hide">Institute Name*</label>
                             <input type="text" placeholder="Institute Name" value="" id="insName" name="insName"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              
              	<div class="fields">
                	<label for="yearOfCompletion" class="hide">Year*</label>
                    
                    <select class="dropdown" id="yearOfCompletion">                                  <option value="-1">Year of passing</option>   <option value="2020">2020</option>   <option value="2019">2019</option>   <option value="2018">2018</option>   <option value="2017">2017</option>   <option value="2016">2016</option>   <option value="2015">2015</option>   <option value="2014">2014</option>   <option value="2013">2013</option>   <option value="2012">2012</option>   <option value="2011">2011</option>   <option value="2010">2010</option>   <option value="2009">2009</option>   <option value="2008">2008</option>   <option value="2007">2007</option>   <option value="2006">2006</option>   <option value="2005">2005</option>   <option value="2004">2004</option>   <option value="2003">2003</option>   <option value="2002">2002</option>   <option value="2001">2001</option>   <option value="2000">2000</option>   <option value="1999">1999</option>   <option value="1998">1998</option>   <option value="1997">1997</option>   <option value="1996">1996</option>   <option value="1995">1995</option>   <option value="1994">1994</option>   <option value="1993">1993</option>   <option value="1992">1992</option>   <option value="1991">1991</option>   <option value="1990">1990</option>   <option value="1989">1989</option>   <option value="1988">1988</option>   <option value="1987">1987</option>   <option value="1986">1986</option>   <option value="1985">1985</option>   <option value="1984">1984</option>   <option value="1983">1983</option>   <option value="1982">1982</option>   <option value="1981">1981</option>   <option value="1980">1980</option>   <option value="1979">1979</option>   <option value="1978">1978</option>   <option value="1977">1977</option>   <option value="1976">1976</option>   <option value="1975">1975</option>   <option value="1974">1974</option>   <option value="1973">1973</option>   <option value="1972">1972</option>   <option value="1971">1971</option>   <option value="1970">1970</option>   <option value="1969">1969</option>   <option value="1968">1968</option>   <option value="1967">1967</option>   <option value="1966">1966</option>   <option value="1965">1965</option>   <option value="1964">1964</option>   <option value="1963">1963</option>   <option value="1962">1962</option>   <option value="1961">1961</option>   <option value="1960">1960</option>   <option value="1959">1959</option>   <option value="1958">1958</option>   <option value="1957">1957</option>   <option value="1956">1956</option>   <option value="1955">1955</option>   <option value="1954">1954</option>   <option value="1953">1953</option>   <option value="1952">1952</option>   <option value="1951">1951</option>   <option value="1950">1950</option>   <option value="1949">1949</option>   <option value="1948">1948</option>   <option value="1947">1947</option>   <option value="1946">1946</option>   <option value="1945">1945</option>   <option value="1944">1944</option>   <option value="1943">1943</option>   <option value="1942">1942</option>   <option value="1941">1941</option>   <option value="1940">1940</option>                                      </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label for="gradeId" class="hide">Grade</label>
                    
                    <select class="dropdown" id="gradeId"> 
                    	
                        <option value="0">Grade</option>
                    	<option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        
                     </select>
                    
                </div>
              
              </div>
                <!--block 4-->
             
              
              
                
                
                </div>
            </div>
            
                
                <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
              </div>
            </div>
            
            </form>
                
                </li>
                
                <li class="tsWorkExpBox profileList">
                   <form action="" method="" >
                
               <h3>Work Experience</h3>
              
              
               <!--block 1-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 1-->
             
             
             
              <!--block 2-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm2" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo2" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 2-->
             
             
              <!--block 3-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm3" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo3" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 3-->
             


   <!--block 4-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm4" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo4" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 4-->             
            
            

            
             
                          
                       
                        
                        <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
              </div>
            </div>
            
            </form>
            
                
                </li>
                
                
                 <li class="tsSubscriptions profileList">
                 
              
             <h3>Subscriptions</h3>   
             
             <div class="col-md-12">
             
             <div class="enrollCol">
             	<ul>
                    <li class="first">Batch No:</li>
                    <li class="second">Enrollment Date</li>                    
                    <li>Institute/Trainer Name</li>
                    <li class="last">Feedback</li>
                </ul>
                <ul>
                    <li class="first">1</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>
 				 <ul>
                    <li class="first">2</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>   
 				 <ul>
                    <li class="first">3</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>                          
             	
             </div>
             
             </div>
             
                            
                   
                     
            
           </li>
           
             <li class="tsResetPassword profileList">
                  <form action="" method="" >
                  
                     <h3>Reset Password</h3>
                     
                       <div class="col-md-12">            
                          <div class="fields">
                            <label for="tsOldPassword1" class="hide">Old Password*</label>
                            <input type="text" placeholder="Old Password" value="" id="tsOldPassword1" name="tsAddress1"  />
                          </div>            
                        </div>           
                        <div class="col-md-12">           
                           <div class="fields">
                            <label for="tsNewPassword" class="hide">New Password*</label>
                            <input type="text" placeholder="New Password" value="" id="tsNewPassword" name="tsNewPassword"  />
                          </div>            
                        </div>
                         <div class="col-md-12">           
                           <div class="fields">
                            <label for="tsReenterPassword" class="hide">Reenter Password*</label>
                            <input type="text" placeholder="Reset Password" value="" id="tsReenterPassword" name="tsReenterPassword"  />
                          </div>            
                        </div>                        
                        <div class="col-md-12">
                            <div class="fields submitFields">
                                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
                            </div>
                        </div>      

                  
                  
                 </form>
                 </li>
          
           <li class="tsStudent profileList">
           
            <form action="" method="" >
           
            <h3>User Role Type</h3>
            
            <div class="col-md-6">                          
            	<div class="fields">
                <label for="tsStudent" class="hide">Student*</label>
                <input type="text" placeholder="Student" value="" id="tsStudent" name="tsStudent"  />
            	</div>                          
          	</div>
            
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
              </div>
            </div>
            
            </form>
           
           </li>
           
           <li class="tsUI profileList">
           
            <form action="" method="" >
           
            <h3>User Identity Information</h3>
            
            <div class="col-md-6">                          
            	<div class="fields">
                <label for="tsUI" class="hide">User Identity Information*</label>
               <select name="tsUI" id="tsUI" class="dropdown">
                		<option value="0">Identity Type</tion>
						<option value="01">Aadhar Number</option>
						<option value="02">Voter Id</option>
						<option value="03">PAN Number</option>
               		</select>
            	</div>                          
          	</div>
            
            <div class="col-md-6">
             <div class="fields">
                <label for="tsInumber" class="hide">Identity Number*</label>
                <input type="text" placeholder="Identity Number" value="" id="tsInumber" name="tsInumber"  />
            	</div>    
            </div>
            
			<div class="col-md-6">                          
            	<div class="fields">
                <label for="tsUI2" class="hide">User Identity Information*</label>
               <select name="tsUI2" id="tsUI2" class="dropdown">
                		<option value="0">Identity Type</tion>
						<option value="01">Aadhar Number</option>
						<option value="02">Voter Id</option>
						<option value="03">PAN Number</option>
               		</select>
            	</div>                          
          	</div>
            
            <div class="col-md-6">
             <div class="fields">
                <label for="tsInumber2" class="hide">Identity Number*</label>
                <input type="text" placeholder="Identity Number" value="" id="tsInumber2" name="tsInumber2"  />
            	</div>    
            </div> 
            
			<div class="col-md-6">                          
            	<div class="fields">
                <label for="tsUI3" class="hide">User Identity Information*</label>
               <select name="tsUI3" id="tsUI3" class="dropdown">
                		<option value="0">Identity Type</tion>
						<option value="01">Aadhar Number</option>
						<option value="02">Voter Id</option>
						<option value="03">PAN Number</option>
               		</select>
            	</div>                          
          	</div>
            
            <div class="col-md-6">
             <div class="fields">
                <label for="tsInumber3" class="hide">Identity Number*</label>
                <input type="text" placeholder="Identity Number" value="" id="tsInumber3" name="tsInumber3"  />
            	</div>    
            </div>                       
            
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
              </div>
            </div>
            
            </form>
           
           </li>
           
           <li class="tsBilling profileList">
           
             <form action="" method="" >
           
            <h3>Billing</h3>
             <!---->
            	<div class="col-md-6">
                	<div class="fields">
                    
                   
                    <ul class="grid">
                    
                    <li class="mb20 card-wrapper">
            	<label class="mb10 hide" for="cardNumber">Cardholder Name</label>
            	<p class="cd">
            	
            		<input type="text" value="" placeholder="Cardholder Name" id="" name="" >
					
				</p>
                
                </li>
                    
        		<li class="mb20 card-wrapper">
            	<label class="mb10 hide" for="cardNumber">ENTER DEBIT CARD NUMBER</label>
            	<p class="cd">
            	
            		<input type="text" value="" placeholder="Enter Debit Card Number" data-type="ts" maxlength="23" id="cn1" name="" autocomplete="off" class="tsCardNumber  text-input large-input cardInput type-tel d" kl_virtual_keyboard_secure_input="on">
					<input type="hidden" class="required" value="" name="cardNumber">
				</p>
                
                </li>
			
            <li style="overflow:hidden; clear:both;" class="fl expiry-wrapper">
     	    	<label for="tsExpMonth" class="mb10 tsExpMonth tsExpYear">EXPIRY DATE</label>
               	<div class="mb10">
               		<div id="tsExpMonthWrapper" class="fl">
                	<select style="width: 80px;" name="ccExpiryMonth" id="tsExpMonth" class="tsExpMonth  combobox required dropdown">
                		<option value="0">MM</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
               		</select>
               		</div>
               		
               	 	<div id="tsExpYearWrapper" class="fl ml10">
               			<select style="width: 80px;" name="ccExpiryYear" id="tsExpYear" class="tsExpYear combobox required dropdown">
             				<option value="0">YY</option>
                           <option value="2016">2016</option>
							  
							<option value="2017">2017</option>
							  
							<option value="2018">2018</option>
							  
							<option value="2019">2019</option>
							  
							<option value="2020">2020</option>
							  
							<option value="2021">2021</option>
							  
							<option value="2022">2022</option>
							  
							<option value="2023">2023</option>
							  
							<option value="2024">2024</option>
							  
							<option value="2025">2025</option>
							  
							<option value="2026">2026</option>
							  
							<option value="2027">2027</option>
							  
							<option value="2028">2028</option>
							  
							<option value="2029">2029</option>
							  
							<option value="2030">2030</option>
							  
							<option value="2031">2031</option>
							  
							<option value="2032">2032</option>
							  
							<option value="2033">2033</option>
							  
							<option value="2034">2034</option>
							  
							<option value="2035">2035</option>
							  
							<option value="2036">2036</option>
							  
							<option value="2037">2037</option>
							  
							<option value="2038">2038</option>
							  
							<option value="2039">2039</option>
							  
							<option value="2040">2040</option>
							  
							<option value="2041">2041</option>
							  
							<option value="2042">2042</option>
							  
							<option value="2043">2043</option>
							  
							<option value="2044">2044</option>
							  
							<option value="2045">2045</option>
							  
							<option value="2046">2046</option>
							  
							<option value="2047">2047</option>
							  
							<option value="2048">2048</option>
							  
							<option value="2049">2049</option>
							  
							<option value="2050">2050</option>
							  
							<option value="2051">2051</option>
							  
							</select>
               	 </div>
               	 <div class="clear"></div>
               </div>
               
               
               
                </li>
                
            
            <li id="tsCvvWrapper" class="ml10 fl relative">
               
                <div class="cvv-block">
                	<label class="mb10" for="cvvNumber">CVV</label>
                	<input type="text" autocomplete="off" class="f-hide" name="">
                	<input type="password" placeholder="CVV" maxlength="4" id="tsCvvBox" name="cvvNumber" autocomplete="off" class="tsCvvBox  text-input small-input width40 required type-tel" kl_virtual_keyboard_secure_input="on">
                	<div class="clear"></div>
                	</div>
                
                <div class="cvv-clue-box hide">
	                <div class="ts-cvv-clue ui-cluetip mt10">
	                	The last 3 digit printed on the signature panel on the back of your debit card.
	                </div>
	            </div>
            </li>
		</ul>
        
        
                   
                    
                    </div>
                </div>
                 <!---->
                 
                <div class="col-md-12">
                    <div class="fields submitFields">
                        <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                        <input type="submit" name="cancel" alt="Cancel" value="Cancel"/>
                    </div>
                </div>
                 
                  </form> 
                
                </li>
            
                
                
            </ul>
          
          	
            
            
            
            
      
           
             
            
            
            	
                
             
                
                
               
            
            
            
            
            
            
            
                      
           
                          
                          
              
            <!--
             <h3>Trainer/Training Institute</h3>
            
             <div class="col-md-12">             
              <div class="fields">
                <label for="tsInsName">Name of the institute*</label>
                <input type="text" value="" id="tsInsName" name="tsInsName"  />
              </div>             
             </div>
             
            <div class="col-md-12">            
                <div class="fields">
                    <label for="tsAddress1">Address 1*</label>
                    <input type="text" value="" id="tsAddress1" name="tsAddress1"  />
                </div>            
            </div>       	 
               
            <div class="col-md-12">           
               <div class="fields">
                <label for="tsAddress1">Address 2*</label>
                <input type="text" value="" id="tsAddress2" name="tsAddress2"  />
              </div>            
            </div>
            
            <div class="col-md-6">
                <div class="fields">
                    <label for="tsEmail">City*</label>
                    <input type="text" value="" id="tsLocation" name="tsLocation"  />
                </div>
            </div>
                         
            <div class="col-md-6">
                <div class="fields">
                    <label for="tsEmail">Pincode*</label>
                    <input type="text" value="" id="tsLocation" name="tsLocation"  />
                </div>   
            </div>
            
			<div class="col-md-6">
              <div class="fields">
                <label class="categories">State*</label>
                <select class="dropdown" name="tsState">
                  <option value="0">Select</option>
                  <option value="1">Karnataka</option>
                  <option value="2">Andhra Pradesh</option>
                  <option value="3">Tamil Nadu</option>
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="fields">
                <label class="categories">District*</label>
                <select class="dropdown" name="tsState">
                  <option value="0">Select</option>
                  <option value="1">District 1</option>
                  <option value="2">District 2</option>
                  <option value="3">District 3</option>
                </select>
              </div>
            </div> 
            <h3>User Identity Information</h3>
            
            <div class="col-md-6">
              <div class="fields">
                <label for="idType">Identity Type*</label>
                <select class="dropdown" name="idType">
                  <option value="0">Select</option>
                  <option value="1">Aadhar Number</option>
                  <option value="2">Pancard Number</option>
                  <option value="3">Driving License Number</option>
                </select>
              </div>
            </div>
            
 			 <div class="col-md-6">
                <div class="fields">
                    <label for="idNumber">Identity Number*</label>
                    <input type="text" value="" id="idNumber" name="idNumber"  />
                </div>
            </div>  
            
            -->

            
          
               
            
            
            
            
            
            
     
        </div>
      </div>
      
    </div>
  </div>