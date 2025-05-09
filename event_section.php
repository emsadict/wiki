<div class="gdlr-core-pbf-column gdlr-core-column-20">
                                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " id="div_1dd7_93">
                                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                            
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-event-item gdlr-core-item-pdb" id="div_1dd7_94">
                                                    <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align gdlr-core-item-mglr" id="div_1dd7_95">
                                                        <div class="gdlr-core-block-item-title-inner clearfix">
                                                            <h3 class="gdlr-core-block-item-title" id="h3_1dd7_32">Upcoming Events</h3>
                                                            <div class="gdlr-core-block-item-title-divider" id="div_1dd7_96"></div>
                                                        </div>
                                                    </div>
                                                    <div class="gdlr-core-event-item-holder clearfix">
                                                        <div class="gdlr-core-event-item-list gdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_97">
                                                            <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                <span class="gdlr-core-date" >07</span>
                                                                <span class="gdlr-core-month">Jan</span>
                                                            </span>
                                                            <div class="gdlr-core-event-item-content-wrap">
                                                                <h3 class="gdlr-core-event-item-title">
                                                                    <a href="#" >Reunion Event : Kingster’s Alumni Golf Tour</a>
                                                                </h3>
                                                                <div class="gdlr-core-event-item-info-wrap">
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_clock_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail">7:00 am - 11:30 pm</span>
                                                                    </span>
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_pin_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail">Kingster Grand Hall</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                      
                                                        <div class="gdlr-core-event-item-list gdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_99">
                                                            <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                <span class="gdlr-core-date" >17</span>
                                                                <span class="gdlr-core-month">Dec</span>
                                                            </span>
                                                            <div class="gdlr-core-event-item-content-wrap">
                                                                <h3 class="gdlr-core-event-item-title">
                                                                    <a href="#" >Fintech &#038; Key Investment Conference</a>
                                                                </h3>
                                                                <div class="gdlr-core-event-item-info-wrap">
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_clock_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail">1:00 pm - 5:00 pm</span>
                                                                    </span>
                                                                    <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                        <span class="gdlr-core-head" >
                                                                            <i class="icon_pin_alt" ></i>
                                                                        </span>
                                                                        <span class="gdlr-core-tail">Kingster Grand Hall</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-pbf-element">
                                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"><a class="gdlr-core-button  gdlr-core-button-transparent gdlr-core-button-no-border" href="#" id="a_1dd7_7"><span class="gdlr-core-content" >View All Events</span><i class="gdlr-core-pos-right fa fa-long-arrow-right" id="i_1dd7_2"  ></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php                                                
    
                                                                  while ($row = $result->fetch_assoc()) {
                                                                 // Extract date and format it for display
                                                                  $eventDate = date("d", strtotime($row['event_date'])); // Extracts the day
                                                                  $eventMonth = date("M", strtotime($row['event_date'])); // Extracts the month
                                                                  $eventTime = htmlspecialchars($row['event_time']);
                                                                  $eventTitle = htmlspecialchars($row['title']);
                                                                  $eventVenue = htmlspecialchars($row['event_venue']);

                                                                  echo '
                                                                  <div class="gdlr-core-event-item-listgdlr-core-style-widget gdlr-core-item-pdlr  clearfix" id="div_1dd7_97"">
                                                                          <span class="gdlr-core-event-item-info gdlr-core-type-start-date-month">
                                                                            <span class="gdlr-core-date">'.$eventDate.'</span>
                                                                              <span class="gdlr-core-month">'.$eventMonth.'</span>
                                                                          </span>
                                                                          <div class="gdlr-core-event-item-content-wrap">
                                                                              <h3 class="gdlr-core-event-item-title">
                                                                                  <a href="#">'.$eventTitle.'</a>
                                                                              </h3>
                                                                                  <div class="gdlr-core-event-item-info-wrap">
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-time">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_clock_alt"></i>
                                                                                      </span>
                                                                                      <span class="gdlr-core-tail">'.$eventTime.'</span>
                                                                                  </span>
                                                                                  <span class="gdlr-core-event-item-info gdlr-core-type-location">
                                                                                      <span class="gdlr-core-head">
                                                                                          <i class="icon_pin_alt"></i>
                                                                                      </span>
                                                                                    <span class="gdlr-core-tail">'.$eventVenue.'</span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>';
                                                              }
                                                              ?>